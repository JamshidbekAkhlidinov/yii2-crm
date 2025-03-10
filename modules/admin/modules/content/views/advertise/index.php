<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:23:21
 *   https://github.com/JamshidbekAkhlidinov
*/

use app\models\Advertise;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\modules\content\search\AdvertiseSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Advertises');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="advertise-index card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(Yii::t('app', 'Create Advertise'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="card-header">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
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
            //'payed_at',
            //'payed_status',
            //'created_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Advertise $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    </div>
</div>
