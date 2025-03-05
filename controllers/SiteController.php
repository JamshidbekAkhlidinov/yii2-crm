<?php

namespace app\controllers;

use app\forms\ContactForm;
use app\forms\SocialNetworkLogin;
use app\modules\admin\actions\SetLocaleAction;
use app\modules\admin\enums\LanguageEnum;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
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
        $posts = Post::find()->orderBy(['id' => SORT_DESC])->limit(7)->all();
        $categories = PostCategory::find()->orderBy(['id' => SORT_DESC])->limit(5)->all();
        $favoritePosts = Post::find()
            ->orderBy(['view_count' => SORT_DESC])
            ->limit(5)
            ->all();
        return $this->render('index', [
            'posts' => $posts,
            'categories' => $categories,
            'favoritePosts' => $favoritePosts
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
