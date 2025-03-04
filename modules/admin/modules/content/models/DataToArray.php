<?php
/*
 *   Jamshidbek Akhlidinov
 *   3 - 3 2025 14:47:50
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\modules\admin\modules\content\models;

use yii\helpers\ArrayHelper;

class DataToArray
{

    public static function getCategories()
    {
        return ArrayHelper::map(
            PostCategory::find()->all(),
            'id',
            'name',
        );
    }

}