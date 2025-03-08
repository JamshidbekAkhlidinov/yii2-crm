<?php
/*
 *   Jamshidbek Akhlidinov
 *   8 - 3 2025 11:33:43
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

use app\modules\admin\enums\StatusEnum;
use app\modules\admin\modules\content\models\Post;
use yii\bootstrap5\Html;
use yii\grid\GridView;

/**
 * @var $dataProvider
 * @var $searchModel
 */

$user = user()->identity;
?>

<div class="card">
    <div class="card-header">
        <?= translate("User data") ?>
    </div>
    <div class="card-body">
        <ul>
            <li>
                <span><b><?= translate("Username") ?>:</b></span>
                <span><?= $user->username ?></span>
            </li>
            <li>
                <span><b><?= translate("Email") ?>:</b></span>
                <span><?= $user->email ?></span>
            </li>
        </ul>
    </div>
</div>


<div class="card">
    <div class="card-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                //'id',
                [
                    'format' => 'raw',
                    'attribute' => 'image',
                    'value' => static function ($model) {
                        return Html::img($model->image, ['width' => '100px', 'height' => '100px']);
                    }
                ],
                [
                    'format' => 'raw',
                    'attribute' => 'title',
                    'value' => static function (Post $model) {
                        return Html::a(
                            $model->title,
                            ['post/view', 'id' => $model->id],
                        );
                    }
                ],
                [
                    'format' => 'raw',
                    'attribute' => 'status',
                    'value' => static function ($model) {
                        return Html::tag(
                            'span',
                            StatusEnum::ALL[$model->status] ?? "",
                            [
                                'class' => [
                                    'badge',
                                    StatusEnum::COLORS[$model->status] ?? "",
                                ]
                            ]
                        );
                    },
                    'filter' => StatusEnum::ALL
                ],
                'view_count',
            ],
        ]); ?>

    </div>

</div>
