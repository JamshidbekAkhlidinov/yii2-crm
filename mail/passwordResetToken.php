<?php

use app\models\User;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user User */
/* @var $token string */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['/auth/reset-password', 'token' => $token]);
?>

Hello <?php echo Html::encode($user->username) ?>,

Follow the link below to reset your password:

<?php echo Html::a(Html::encode($resetLink), $resetLink) ?>
