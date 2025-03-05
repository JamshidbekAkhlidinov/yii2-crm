<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

/**
 * @var $model \app\forms\SignupForm
 */

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="auth-page-wrapper pt-5">

    <!-- auth page content -->
    <div class="auth-page-content">
        <div class="container">


            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card mt-4">

                        <div class="card-body p-4">

                            <div class="text-center mt-sm-5 mb-4 text-white-50">
                                <div>
                                    <a href="<?= Url::to(['site/index']) ?>" class="d-inline-block auth-logo">
                                        <img src="/images/new/logo-white.png" alt="" height="20">
                                    </a>
                                </div>
                                <h5 class="text-primary mt-2">Create New Account</h5>
                            </div>

                            <div class="p-2 mt-4">

                                <?php $form = ActiveForm::begin([
                                    'id' => 'login-form',
                                    'fieldConfig' => [
                                        'template' => "{label}\n{input}\n{error}",
                                        'labelOptions' => ['class' => 'form-label'],
                                        'inputOptions' => ['class' => 'form-control'],
                                        'errorOptions' => ['class' => 'invalid-feedback'],
                                    ],
                                ]); ?>


                                <?= $form->field($model, 'email')->textInput(['placeholder' => "Enter email"]) ?>

                                <?= $form->field($model, 'username')->textInput(['placeholder' => "Enter username"]) ?>

                                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Enter password"]) ?>

                                <?= $form->field($model, 'password_confirm')->passwordInput(['placeholder' => "Enter password confirm"]) ?>


                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign Up</button>
                                </div>

                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title text-muted">Create account with</h5>
                                    </div>

                                    <?= yii\authclient\widgets\AuthChoice::widget([
                                        'baseAuthUrl' => ['site/auth'],
                                        'popupMode' => false,
                                        'options' => [
                                            'style' => 'display: flex;    justify-content: center;'
                                        ]
                                    ]) ?>

                                </div>
                                <?php ActiveForm::end() ?>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Already have an account ?
                            <a
                                    href="<?= Url::to(['auth/login']) ?>"
                                    class="fw-semibold text-primary text-decoration-underline">
                                Signin
                            </a>
                        </p>
                    </div>

                </div>
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end auth page content -->
</div>
<!-- end auth-page-wrapper -->