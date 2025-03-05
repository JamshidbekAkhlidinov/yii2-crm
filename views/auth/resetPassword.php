<?php

use app\forms\PasswordResetRequestForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var ActiveForm $form
 * @var PasswordResetRequestForm $model
 */

$this->title = translate('Reset password');
?>

<?php $form = ActiveForm::begin(['id' => 'password-reset']); ?>
<div class="site-resetPassword mt-5">
    <div class="row justify-content-center">
        <div class="col-sm-4">
            <div class="card mb-2">
                <div class="card-body">
                    <h1 class="h4 text-muted text-center"><?php echo Html::encode($this->title) ?></h1>
                    <?php echo $form->field($model, 'password')->passwordInput() ?>
                    <div class="form-group">
                        <?php echo Html::submitButton(translate('Change Password'), ['class' => 'btn btn-primary btn-lg btn-block', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php ActiveForm::end(); ?>
