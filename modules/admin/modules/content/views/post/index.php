<?php
/*
 *   Jamshidbek Akhlidinov
 *   25 - 12 2023 11:40:02
 *   https://github.com/JamshidbekAkhlidinov
*/

use app\modules\admin\modules\content\models\DataToArray;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\modules\admin\modules\content\search\PostSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = translate("Posts");
params()['breadcrumbs'][] = ['label' => translate("Content"), 'url' => ['/admin/content']];
params()['breadcrumbs'][] = $this->title;
?>
<div class="post-index card">
    <div class="card-header d-flex justify-content-between">
        <h1><?= Html::encode($this->title) ?></h1>
        <p>
            <?= Html::a(translate('Create Post'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    'format' => 'raw',
                    'attribute' => 'image',
                    'value' => static function ($model) {
                        return Html::img($model->image, ['width' => '100px','height'=>'100px']);
                    }
                ],
                'title',
                [
                    'attribute' => 'category_id',
                    'value' => static function (Post $model) {
                        $items = [];
                        foreach ($model->postCategoryLinkers as $linker) {
                            $items[] = $linker->postCategory->name;
                        }
                        return implode(', ', $items);
                    },
                    'filter'=> DataToArray::getCategories(),
                ],
                [
                    'attribute' => 'tag',
                    'value' => static function (Post $model) {
                        $items = [];
                        foreach ($model->postTagLinkers as $linker) {
                            $items[] = $linker->tag->name;
                        }
                        return implode(', ', $items);
                    }
                ],
                //'status',
                //'view_count',
                //'created_by',
                //'created_at',
                //'updated_at',
                //'updated_by',
                [
                    'class' => ActionColumn::className(),
                    'urlCreator' => function ($action, Post $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

    </div>
</div>
