<?php
/*
 *   Jamshidbek Akhlidinov
 *   25 - 1 2024 23:45:20
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\controllers;

use yii\filters\AccessControl;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class BaseController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                //'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['signup', 'login'],
                        'allow' => false,
                        'roles' => ['@'],
                    ],
                    [
                        'allow' => true,
                        'roles' => ['@', '?'],
                    ],
                ],
            ],
        ];
    }

    /**
     * @throws BadRequestHttpException
     */
    public function beforeAction($action)
    {
        if (false && controller()->route !== 'site/turn-off') {
            return $this->redirect(['site/turn-off']);
        }
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }
}