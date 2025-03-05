<?php

namespace app\forms;

use app\commands\SendEmailCommand;
use app\models\User;
use app\modules\admin\models\UserToken;
use cheatsheet\Time;
use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Password reset form
 */
class ResendEmailForm extends Model
{
    /**
     * @var user email
     */
    public $email;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidArgumentException if token is empty or not valid
     */
    public function __construct($config = [])
    {
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'exist',
                'targetClass' => User::class,
                'filter' => ['status' => User::STATUS_NOT_ACTIVE],
                'message' => 'There is no user expecting activation with such email.'
            ],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'email' => translate('E-mail')
        ];
    }

    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_NOT_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_ACTIVATION, Time::SECONDS_IN_A_DAY);
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => translate('Activation email'),
                'view' => 'activation',
                'to' => $this->email,
                'params' => [
                    'url' => Url::to(['/auth/activation', 'token' => $token->token], true)
                ]
            ]));

            return true;
        }

        return false;
    }
}
