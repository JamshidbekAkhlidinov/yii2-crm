<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\forms\SignupForm;
use app\modules\admin\enums\UserRolesEnum;
use Yii;
use yii\base\Exception;
use yii\web\Response;

class AuthController extends BaseController
{
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $this->layout = 'auth';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            if (!user()->can(UserRolesEnum::ROLE_USER)) {
                return $this->redirect(['/admin']);
            }
            return $this->goBack();
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        user()->logout();
        return $this->goHome();
    }


    /**
     * @throws Exception
     */
    public function actionSignup()
    {
        $this->layout = 'auth';
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            $user = $model->signup();
            if ($user) {
                Yii::$app->getUser()->login($user);
                return $this->goHome();
            }
        }
        return $this->render('signup', [
            'model' => $model
        ]);
    }

}