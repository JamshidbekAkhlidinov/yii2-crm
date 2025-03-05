<?php

namespace app\controllers;

use app\forms\LoginForm;
use app\forms\PasswordResetRequestForm;
use app\forms\ResendEmailForm;
use app\forms\ResetPasswordForm;
use app\forms\SignupForm;
use app\models\User;
use app\modules\admin\enums\UserRolesEnum;
use app\modules\admin\models\UserToken;
use InvalidArgumentException;
use Yii;
use yii\base\Exception;
use yii\web\BadRequestHttpException;
use yii\web\ForbiddenHttpException;
use yii\web\Response;

class AuthController extends BaseController
{

    public $layout = 'auth';

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
                //Yii::$app->getUser()->login($user);
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => translate(
                        'Your account has been successfully created. Check your email for further instructions.'
                    ),
                    'options' => ['class' => 'alert-success']
                ]);
            }
            return $this->goHome();
        }
        return $this->render('signup', [
            'model' => $model
        ]);
    }

    /**
     * @param $token
     * @return array|string|Response
     * @throws ForbiddenHttpException
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLoginByPass($token)
    {
        $user = UserToken::use($token, UserToken::TYPE_LOGIN_PASS);

        if ($user === null) {
            throw new ForbiddenHttpException();
        }

        Yii::$app->user->login($user);
        return $this->goHome();
    }

    /**
     **
     * @param $token
     * @return Response
     * @throws BadRequestHttpException
     */
    public function actionActivation($token)
    {
        $token = UserToken::find()
            ->byType(UserToken::TYPE_ACTIVATION)
            ->byToken($token)
            ->notExpired()
            ->one();

        if (!$token) {
            throw new BadRequestHttpException;
        }
        /**
         * @var $token UserToken
         */
        $user = $token->user;
        $user->updateAttributes([
            'status' => User::STATUS_ACTIVE
        ]);
        $token->delete();
        Yii::$app->getUser()->login($user);
        Yii::$app->getSession()->setFlash('alert', [
            'body' => translate('Your account has been successfully activated.'),
            'options' => ['class' => 'alert-success']
        ]);
        return $this->goHome();
    }

    /**
     * @return string|Response
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => translate('Check your email for further instructions.'),
                    'options' => ['class' => 'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => translate('Sorry, we are unable to reset password for email provided.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * @param $token
     * @return string|Response
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('alert', [
                'body' => translate('New password was saved.'),
                'options' => ['class' => 'alert-success']
            ]);
            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    public function actionResendEmail()
    {
        $model = new ResendEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => translate('Check your email for further instructions.'),
                    'options' => ['class' => 'alert-success']
                ]);

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('alert', [
                    'body' => translate('Sorry, we are unable to resend activation link for email provided.'),
                    'options' => ['class' => 'alert-danger']
                ]);
            }
        }

        return $this->render('resend-email', [
            'model' => $model,
        ]);
    }
}