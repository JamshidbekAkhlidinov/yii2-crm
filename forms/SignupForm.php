<?php
/*
 *   Jamshidbek Akhlidinov
 *   27 - 12 2023 20:48:45
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\forms;

use app\commands\SendEmailCommand;
use app\models\User;
use app\modules\admin\models\UserToken;
use cheatsheet\Time;
use Yii;
use yii\base\Exception;
use yii\base\Model;
use yii\helpers\Url;

/**
 * Signup form
 */
class SignupForm extends Model
{
    /**
     * @var string
     */
    public $username;
    /**
     * @var string
     */
    public $email;
    /**
     * @var string
     */
    public $password;
    /**
     * @var string
     */
    public $password_confirm;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password', 'password_confirm'], 'required'],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'unique',
                'targetClass' => User::class,
                'message' => translate('This username has already been taken.')
            ],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => User::class,
                'message' => translate('This email address has already been taken.')
            ],

            ['password', 'string', 'min' => 6],
            ['password_confirm', 'compare', 'compareAttribute' => 'password', 'skipOnEmpty' => false],
        ];
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => translate('Username'),
            'email' => translate('E-mail'),
            'password' => translate('Password'),
            'password_confirm' => translate('Confirm Password')
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     * @throws Exception
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->username = $this->username;
            $user->email = $this->email;
            $user->status = User::STATUS_NOT_ACTIVE;
            $user->setPassword($this->password);
            if (!$user->save()) {
                throw new Exception("User couldn't be  saved");
            };
            $user->afterSignup();

            $token = UserToken::create(
                $user->id,
                UserToken::TYPE_ACTIVATION,
                Time::SECONDS_IN_A_DAY
            );
            Yii::$app->commandBus->handle(new SendEmailCommand([
                'subject' => translate( 'Activation email'),
                'view' => 'activation',
                'to' => $this->email,
                'params' => [
                    'url' => Url::to(['/auth/activation', 'token' => $token->token], true)
                ]
            ]));

            return $user;
        }

        return null;
    }
}
