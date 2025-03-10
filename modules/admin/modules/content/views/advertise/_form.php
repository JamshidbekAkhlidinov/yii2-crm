<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:23:21
 *   https://github.com/JamshidbekAkhlidinov
*/

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Advertise $model */
/** @var yii\bootstrap5\ActiveForm $form */
?>

<div class="advertise-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'period')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'align')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'status')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'payed_at')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'payed_status')->textInput() ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'created_at')->textInput() ?>
        </div>
    </div>
    <div class="form-group pt-2">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
