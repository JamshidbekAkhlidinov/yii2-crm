<?php

namespace app\controllers;

use app\forms\ContactForm;
use app\forms\LoginForm;
use app\forms\SignupForm;
use app\forms\SocialNetworkLogin;
use app\modules\admin\actions\SetLocaleAction;
use app\modules\admin\enums\LanguageEnum;
use app\modules\admin\enums\UserRolesEnum;
use Yii;
use yii\authclient\AuthAction;
use yii\base\Exception;
use yii\helpers\Json;
use yii\web\Response;

class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'set-locale' => [
                'class' => SetLocaleAction::class,
                'locales' => array_keys(LanguageEnum::LABELS),
                'localeCookieName' => 'lang',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
            'auth' => ['class' => AuthAction::class,
                'successCallback' => [$this, 'successOAuthCallback']
            ]
        ];
    }

    public function successOAuthCallback($client)
    {
        $name = get('authclient');
        $authForm = new SocialNetworkLogin($name, $client);
        return $authForm->login();
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }


    public function actionTurnOff()
    {
        $this->layout = 'auth';
        return $this->render('turn');
    }

}
