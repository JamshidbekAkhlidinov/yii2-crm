<?php

namespace app\forms;

use app\models\User;
use Yii;
use yii\base\Model;

class SocialNetworkLogin extends Model
{
    public $name;
    public $data;

    public function __construct($name, $data, $config = [])
    {
        $this->data = $data;
        $this->name = $name;
        parent::__construct($config);
    }


    public function login()
    {
        $name = $this->name;
        $data = $this->data->getUserAttributes();
        if ($name == 'google') {
            $item = [
                'email' => $data['email'],
                'password' => $data['id'],
                'username' => explode("@", $data['email'])[0],
                'firstname' => $data['given_name'],
                'lastname' => $data['family_name'],
                'is_confirmed' => $data['verified_email'],
                'avatar' => $data['picture']
            ];
            $user = User::findOne(['email' => $item['email']]);
            if ($item['is_confirmed']) {
                if (!$user) {
                    $user = new User([
                        'username' => $item['username'],
                        'email' => $item['email'],
                        'status' => User::STATUS_ACTIVE,
                    ]);
                    $user->setPassword($item['password']);
                    if ($user->save()) {
                        $user->afterSignup([
                            'firstname' => $item['firstname'],
                            'lastname' => $item['lastname'],
                            'avatar_path' => $item['avatar'],
                        ]);
                    } else {
                        print_r($user->getErrors());
                        exit();
                    }
                }
                Yii::$app->user->login($user);
                return true;
            }
            return false;
        }
        return false;
    }
}