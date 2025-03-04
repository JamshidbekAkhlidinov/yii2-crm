<?php

/**
 * @var View $this
 */

use app\modules\admin\widgets\modal\ModalWidget;
use app\modules\admin\widgets\slider\enums\SwiperTypeEnum;
use app\modules\admin\widgets\slider\SwiperSliderWidget;
use yii\web\View;

$this->title = translate("Admin dashboard");
Yii::$app->params['breadcrumbs'][] = $this->title;
?>

<div class="admin-default-index">
    <h1 class="pb-2"><?= $this->context->action->uniqueId ?></h1>

    <div class="row col-md-12">
        <?= SwiperSliderWidget::widget([
            'type' => SwiperTypeEnum::TYPE_COVERFLOW,
            'items' => [
                "/images/small/img-1.jpg",
                "/images/small/img-2.jpg",
                "/images/small/img-3.jpg",
                "/images/small/img-4.jpg",
                "/images/small/img-5.jpg",
                "/images/small/img-6.jpg",
                "/images/small/img-7.jpg",
                "/images/small/img-8.jpg",
                 "/images/small/img-9.jpg",
            ],
            'options' => [
                "style" => "width:100%"
            ]
        ]) ?>
    </div>

</div>
