<?php
/*
 *   Jamshidbek Akhlidinov
 *   25 - 12 2023 3:18:15
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\modules\admin\controllers;

use app\modules\admin\forms\TestForm;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionDate()
    {
        $form = new TestForm();
        return $this->render('date', [
            'form' => $form,
        ]);
    }

    public function actionModal()
    {
        return "<h2>Jamshidbek Akhlidinov</h2>";
    }

}