<?php
/*
 *   Jamshidbek Akhlidinov
 *   10 - 03 2025 06:24:31
 *   https://github.com/JamshidbekAkhlidinov
*/

use alexantr\elfinder\InputFile;
use app\models\Advertise;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Advertise $model */
/** @var yii\bootstrap5\ActiveForm $form */

$this->registerJs(<<<JS
document.addEventListener("DOMContentLoaded", function () {
    let periodInput = document.getElementById("advertise-period");
    let alignInput = document.getElementById("advertise-align");
    let priceInput = document.getElementById("price_id");

    function calculatePrice() {
        let period = parseInt(periodInput.value) || 0;
        let align = parseInt(alignInput.value) || 0;
        let price = period * 200 + (align === 10 ? 300 : 200);
        priceInput.value = price;
        console.log(price)
    }

    periodInput.addEventListener("input", calculatePrice);
    alignInput.addEventListener("change", calculatePrice);
});
JS,\yii\web\View::POS_HEAD);
?>

<div class="advertise-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'image')->widget(
                InputFile::class,
                [
                    'clientRoute' => '/post/input',
                    'options' => [
                        'id' => 'post_image_input',
                    ]
                ]
            ); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'url')->input('url') ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'period')->input('number', ['id' => 'advertise-period']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'align')->dropDownList(
                Advertise::align_list,
                [
                    'prompt' => translate('--Select--'),
                    'id' => 'advertise-align'
                ]
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'price')->input('number', ['readonly' => true, 'id' => 'price_id']) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group pt-2">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
