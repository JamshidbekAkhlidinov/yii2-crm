<?php
/*
 *   Jamshidbek Akhlidinov
 *   8 - 3 2025 11:33:3
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\controllers;

use app\models\PostSearch;

class UserController extends BaseController
{
    public function actionProfile()
    {
        $searchModel = new PostSearch(['created_by' => user()->id, 'active' => false]);
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('profile', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
}