<?php

namespace app\modules\admin\modules\file\controllers;

use alexantr\elfinder\CKEditorAction;
use alexantr\elfinder\ConnectorAction;
use alexantr\elfinder\InputFileAction;
use alexantr\elfinder\TinyMCEAction;
use app\modules\admin\enums\UserRolesEnum;
use app\modules\admin\modules\rbac\enums\PermissionsEnum;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `file` module
 */
class DefaultController extends Controller
{

    public function actions()
    {
        return [
            'connector' => [
                'class' => ConnectorAction::className(),
                'options' => [
                    'roots' => [
                        [
                            'driver' => 'LocalFileSystem',
                            'path' => Yii::getAlias('@webroot') . DIRECTORY_SEPARATOR . 'uploads',
                            'URL' => Yii::getAlias('@web') . '/uploads/',
                            'mimeDetect' => 'internal',
                            'imgLib' => 'gd',
                            'accessControl' => function ($attr, $path) {
                                $user = Yii::$app->user;

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

                                if ($attr === 'rm' && !$user->can(PermissionsEnum::file_manager_delete)) {
                                    return false;
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

    public function actionIndex()
    {
        return $this->render('index');
    }
}
