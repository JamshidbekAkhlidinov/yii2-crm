<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */

/** @var app\forms\LoginForm $model */

use yii\bootstrap5\ActiveForm;
use yii\helpers\Url;

$this->title = 'Login';
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

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="text-center mt-sm-5 mb-4 text-white-50">
                                        <div>
                                            <a href="<?= Url::to(['site/index']) ?>" class="d-inline-block auth-logo">
                                                <img src="/images/new/logo-white.png" alt="" height="20">
                                            </a>
                                        </div>
                                    </div>
                                </div>
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

                                <?= $form->field($model, 'username')->textInput(['placeholder' => "Enter username"]) ?>

                                <div class="float-end">
                                    <a href="<?=URL::to(['auth/request-password-reset'])?>" class="text-muted">Forgot password?</a>
                                </div>

                                <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Enter password"]) ?>

                                <?= $form->field($model, 'rememberMe')->checkbox([
                                    'template' => "<div class=\"form-check\">{input} {label}</div>\n<div class=\"col-lg-8\">{error}</div>",
                                ]) ?>

                                <div class="mt-4">
                                    <button class="btn btn-success w-100" type="submit">Sign In</button>
                                </div>


                                <div class="mt-4 text-center">
                                    <div class="signin-other-title">
                                        <h5 class="fs-13 mb-4 title">Sign In with</h5>
                                    </div>
                                    <div>

                                        <?= yii\authclient\widgets\AuthChoice::widget([
                                            'baseAuthUrl' => ['site/auth'],
                                            'popupMode' => false,
                                            'options' => [
                                                'style' => 'display: flex;    justify-content: center;'
                                            ]
                                        ]) ?>

                                    </div>
                                </div>

                                <?php ActiveForm::end() ?>

                            </div>
                        </div>
                        <!-- end card body -->
                    </div>
                    <!-- end card -->

                    <div class="mt-4 text-center">
                        <p class="mb-0">Don't have an account ? <a href="<?= Url::to(['auth/signup']) ?>"
                                                                   class="fw-semibold text-primary text-decoration-underline">
                                Signup </a></p>
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
