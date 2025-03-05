<?php
/**
 * @var $this \yii\web\View
 * @var $url User
 */

use app\models\User;

?>
<?php echo translate( 'Your activation link: {url}', ['url' => Yii::$app->formatter->asUrl($url)]) ?>
