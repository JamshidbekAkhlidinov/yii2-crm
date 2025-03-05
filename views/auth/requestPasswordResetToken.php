<?php

use app\forms\PasswordResetRequestForm;
use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/**
 * @var yii\web\View $this
 * @var ActiveForm $form
 * @var PasswordResetRequestForm $model
 */

$this->title = translate('Request password reset');
?>


<div class="auth-page-wrapper pt-5">

    <div class="auth-page-content">
        <div class="container">

            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4 card-bg-fill">

                        <div class="card-body p-4">

                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="index.html" class="d-inline-block auth-logo">
                                        <img src="/images/new/logo-white.png" alt="" height="20">
                                    </a>
                                </div>
                            </div>

                            <div class="text-center mt-2">
                                <h5 class="text-primary">Forgot Password?</h5>
                                <p class="text-muted">Reset password</p>

                                <lord-icon src="https://cdn.lordicon.com/rhvddzym.json" trigger="loop"
                                           colors="primary:#8c68cd" class="avatar-xl"></lord-icon>

                            </div>

                            <div class="alert border-0 alert-warning text-center mb-2 mx-2" role="alert">
                                Enter your email and instructions will be sent to you!
                            </div>
                            <div class="p-2">
                                <?php $form = ActiveForm::begin(['id' => 'password-reset']); ?>


                                <?php echo $form->field($model, 'email')->input('email') ?>


                                <div class="text-center mt-4">
                                    <button class="btn btn-primary w-100" type="submit">Send Reset Link</button>
                                </div>
                                <?php ActiveForm::end(); ?>
                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Wait, I remember my password... <a href="<?=Url::to(['auth/login'])?>"
                                                                           class="fw-semibold text-primary text-decoration-underline">
                                Click here </a></p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>

</div>
