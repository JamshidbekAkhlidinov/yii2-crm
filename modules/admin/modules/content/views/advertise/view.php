<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:23:21
 *   https://github.com/JamshidbekAkhlidinov
*/

use app\models\Advertise;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Advertise $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Advertises'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="advertise-view card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

            <?= Html::a(Yii::t('app', 'Success'), ['status', 'id' => $model->id, 'status' => Advertise::status_active], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to update this item?'),
                ],
            ]) ?>

            <?= Html::a(Yii::t('app', 'Cancel'), ['status', 'id' => $model->id, 'status' => Advertise::status_cancel], [
                'class' => 'btn btn-warning',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to update this item?'),
                ],
            ]) ?>

            <?= Html::a(Yii::t('app', 'Done'), ['status', 'id' => $model->id, 'status' => Advertise::status_done], [
                'class' => 'btn btn-success',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to update this item?'),
                ],
            ]) ?>



            <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>

        </p>
    </div>
    <div class="card-header">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => static function ($model) {
                        return Html::img($model->image, ['width' => '100px']);
                    }
                ],
                'url:url',
                'description',
                'period',
                'price',
                [
                    'attribute' => 'align',
                    'value' => static function ($model) {
                        return Advertise::align_list[$model->align] ?? "";
                    }
                ],
                [
                    'attribute' => 'status',
                    'value' => static function ($model) {
                        return Advertise::status_list[$model->status] ?? "";
                    }
                ],
                'payed_at',
                'payed_status',
                'created_at',
            ],
        ]) ?>
    </div>
</div>
