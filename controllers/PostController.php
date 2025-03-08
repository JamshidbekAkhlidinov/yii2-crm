<?php

namespace app\controllers;

use alexantr\elfinder\CKEditorAction;
use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\InputFileAction;
use alexantr\elfinder\TinyMCEAction;
use app\models\PostSearch;
use app\modules\admin\enums\UserRolesEnum;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
use app\modules\admin\modules\rbac\enums\PermissionsEnum;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{

    public function actions()
    {
        $user = Yii::$app->user;
        $baseUploadPath = Yii::getAlias('@webroot') . "/uploads";
        $baseUploadUrl = Yii::getAlias('@web') . "/uploads";

        $userFolder = $baseUploadPath;
        $userUrl = $baseUploadUrl;

        if ($user->identity) {
            $userId = $user->id;

            if ($user->can(UserRolesEnum::ROLE_ADMINISTRATOR)) {
                $userFolder = $baseUploadPath;
                $userUrl = $baseUploadUrl;
            } else {
                $userFolder = "{$baseUploadPath}/users/{$userId}";
                $userUrl = "{$baseUploadUrl}/users/{$userId}";

                if (!is_dir($userFolder)) {
                    mkdir($userFolder, 0777, true);
                }

                $testFile = "{$userFolder}/test.txt";
                if (!file_exists($testFile)) {
                    file_put_contents($testFile, $user->identity->username);
                }
            }
        }

        return [
            'connector' => [
                'class' => ConnectorAction::className(),
                'options' => [
                    'roots' => [
                        [
                            'driver' => 'LocalFileSystem',
                            'path' => $userFolder,
                            'URL' => $userUrl,
                            'mimeDetect' => 'internal',
                            'imgLib' => 'gd',
                            'accessControl' => function ($attr, $path) use ($userFolder) {
                                $user = Yii::$app->user;

                                if ($user) {
                                    if (strpos(basename($path), '.') === 0) {
                                        return !($attr == 'read' || $attr == 'write');
                                    }

                                    if ($user->can(UserRolesEnum::ROLE_ADMINISTRATOR)) {
                                        return null;
                                    }

                                    if ($attr === 'read') {
                                        return $user->can(PermissionsEnum::file_manager_view);
                                    }

                                    if ($attr === 'write' || $attr === 'upload') {
                                        return $user->can(PermissionsEnum::file_manager_upload);
                                    }

                                    if ($attr === 'rm') {
                                        return $user->can(PermissionsEnum::file_manager_delete);
                                    }

                                    //return strpos(realpath($path), realpath($userFolder)) === 0;
                                }
                                return false;
                            },
                            'uploadDeny' => [
                                'text/x-php', 'text/php', 'application/x-php', 'application/php'
                            ],
                            'disabled' => Yii::$app->user->can(PermissionsEnum::file_manager_delete) ? [] : ['rm'],

                        ],
                    ],
                ],
            ],
            'input' => [
                'class' => InputFileAction::className(),
                'connectorRoute' => 'connector',
            ],
            'ckeditor' => [
                'class' => CKEditorAction::className(),
                'connectorRoute' => 'connector',
            ],
            'tinymce' => [
                'class' => TinyMCEAction::className(),
                'connectorRoute' => 'connector',
            ],
        ];
    }

    public function actionIndex($category_id = null, $search = null)
    {
        $searchModel = new PostSearch(['category_id' => $category_id, 'title' => $search]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        $categories = PostCategory::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();
        $favoritePosts = Post::find()
            ->orderBy(['view_count' => SORT_DESC])
            ->active()
            ->limit(5)
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => $categories,
            'favoritePosts' => $favoritePosts
        ]);
    }

    public function actionView($id)
    {
        $categories = PostCategory::find()
            ->orderBy(['id' => SORT_DESC])
            ->active()
            ->limit(5)
            ->all();
        $model = $this->findModel($id);
        if ($model->created_by !== user()->id) {
            $model->view_count++;
            $model->save();
        }
        $favoritePosts = Post::find()
            ->orderBy(['view_count' => SORT_DESC])
            ->active()
            ->limit(5)
            ->all();
        return $this->render('view', [
            'model' => $model,
            'categories' => $categories,
            'favoritePosts' => $favoritePosts
        ]);
    }

    protected function findModel($id)
    {
        if (($model = Post::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(translate('The requested page does not exist.'));
    }

}