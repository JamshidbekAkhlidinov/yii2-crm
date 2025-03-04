<?php

namespace app\forms;


use app\commands\SendEmailCommand;
use app\models\User;
use app\modules\admin\models\UserToken;
use cheatsheet\Time;
use Yii;
use yii\base\Model;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    /**
     * @var user email
     */
    public $email;

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
                'filter' => ['status' => User::STATUS_ACTIVE],
                'message' => 'There is no user with such email.'
            ],
        ];
    }

    /**
     * Sends an email with a link, for resetting the password.
     *
     * @return boolean whether the email was send
     */
    public function sendEmail()
    {
        /* @var $user User */
        $user = User::findOne([
            'status' => User::STATUS_ACTIVE,
            'email' => $this->email,
        ]);

        if ($user) {
            $token = UserToken::create($user->id, UserToken::TYPE_PASSWORD_RESET, Time::SECONDS_IN_A_DAY);
            if ($user->save()) {
                return Yii::$app->commandBus->handle(
                    new SendEmailCommand([
                        'to' => $this->email,
                        'subject' => translate('Password reset for {name}', ['name' => Yii::$app->name]),
                        'view' => 'passwordResetToken',
                        'params' => [
                            'user' => $user,
                            'token' => $token->token
                        ]
                    ])
                );
            }
        }

        return false;
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
}
