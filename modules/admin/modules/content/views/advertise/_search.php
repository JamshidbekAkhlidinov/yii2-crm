<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:23:21
 *   https://github.com/JamshidbekAkhlidinov
*/

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\modules\admin\modules\content\search\AdvertiseSearch $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="advertise-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'image') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'period') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'align') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'payed_at') ?>

    <?php // echo $form->field($model, 'payed_status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
