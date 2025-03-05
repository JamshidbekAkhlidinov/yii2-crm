<?php

namespace app\controllers;

use app\forms\ContactForm;
use app\forms\SocialNetworkLogin;
use app\modules\admin\actions\SetLocaleAction;
use app\modules\admin\enums\LanguageEnum;
use Yii;
use yii\authclient\AuthAction;
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
