<?php
/*
 *   Jamshidbek Akhlidinov
 *   29 - 11 2023 18:49:27
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov/yii2basic
 */

namespace app\modules\admin\models;

use app\models\TelegramCompany;
use app\models\User;
use app\modules\admin\modules\content\models\Page;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
use app\modules\admin\modules\rbac\models\AuthItem;
use app\modules\admin\modules\rbac\models\AuthRule;
use yii\helpers\ArrayHelper;

class ModelToData
{

    public static function getAuthItems()
    {
        return ArrayHelper::map(
            AuthItem::find()->all(),
            'name',
            'name',
        );
    }

    public static function getUsers()
    {
        return ArrayHelper::map(
            User::find()->all(),
            'id',
            'username',
        );
    }

    public static function getAuthRule()
    {
        return ArrayHelper::map(
            AuthRule::find()->all(),
            'name',
            'name',
        );
    }

    public static function getTelegramCompany()
    {
        return ArrayHelper::map(
            TelegramCompany::find()->all(),
            'id',
            'name',
        );
    }
}