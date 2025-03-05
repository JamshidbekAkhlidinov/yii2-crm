<?php

namespace app\controllers;

use app\models\PostSearch;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class PostController extends Controller
{
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        $categories = PostCategory::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();
        $favoritePosts = Post::find()
            ->orderBy(['view_count' => SORT_DESC])
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
            ->limit(5)
            ->all();
        $model = $this->findModel($id);
        $model->view_count++;
        $model->save();
        $favoritePosts = Post::find()
            ->orderBy(['view_count' => SORT_DESC])
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