<?php

/**
 * @var View $this
 */

use app\modules\admin\modules\content\models\Page;
use app\modules\admin\modules\content\models\Post;
use app\modules\admin\modules\content\models\PostCategory;
use app\modules\admin\modules\content\models\PostTag;
use app\modules\admin\widgets\CardWidget;
use yii\helpers\Url;
use yii\web\View;

$this->title = translate("Dashboard");
Yii::$app->params['breadcrumbs'][] = $this->title;
?>

<div class="row">

    <?= CardWidget::widget([
        'icon' => "ri-pages-line",
        'name' => "Pages",
        'amount' => Page::find()->count() . " pcs",
        'bgColor' => "bg-success-subtle",
        'textColor' => "text-success",
        'url'=> Url::to(['content/page/create'])
    ]) ?>

    <?= CardWidget::widget([
        'icon' => "ri-pages-line",
        'name' => "Post categories",
        'amount' => PostCategory::find()->count() . " pcs",
        'bgColor' => "bg-success-subtle",
        'textColor' => "text-success",
        'url'=> Url::to(['content/post-category'])
    ]) ?>

    <?= CardWidget::widget([
        'icon' => "ri-pages-line",
        'name' => "Post tags",
        'amount' => PostTag::find()->count() . " pcs",
        'bgColor' => "bg-success-subtle",
        'textColor' => "text-success",
        'url'=> Url::to(['content/post-tag'])
    ]) ?>

    <?= CardWidget::widget([
        'icon' => "ri-pages-line",
        'name' => "Posts",
        'amount' => Post::find()->count() . " pcs",
        'bgColor' => "bg-success-subtle",
        'textColor' => "text-success",
        'url'=> Url::to(['content/post/create'])
    ]) ?>


</div>

