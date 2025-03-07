<?php
/*
 *   Jamshidbek Akhlidinov
 *   5 - 3 2025 12:52:6
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\forms;

use app\modules\admin\models\UserToken;
use yii\base\InvalidArgumentException;
use yii\base\Model;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    /**
     * @var
     */
    public $password;

    /**
     * @var UserToken
     */
    private $token;

    /**
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws \yii\base\InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        /** @var UserToken $tokenModel */
        $this->token = UserToken::find()
            ->notExpired()
            ->byType(UserToken::TYPE_PASSWORD_RESET)
            ->byToken($token)
            ->one();

        if (!$this->token) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }

    /**
     * Resets password.
     *
     * @return boolean if password was reset.
     */
    public function resetPassword()
    {
        $user = $this->token->user;
        $user->password = $this->password;
        if ($user->save()) {
            $this->token->delete();
        };

        return true;
    }

    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'password' => translate('Password')
        ];
    }
}
