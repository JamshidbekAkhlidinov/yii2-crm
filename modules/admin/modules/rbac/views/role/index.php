<?php
/*
 *   Jamshidbek Akhlidinov
 *   4 - 3 2025 12:0:2
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

/**
 * @var $roles \app\modules\admin\modules\rbac\models\AuthItem
 * @var $role \app\modules\admin\modules\rbac\models\AuthItem
 * @var $permissions \app\modules\admin\modules\rbac\models\AuthItem
 * @var $permission \app\modules\admin\modules\rbac\models\AuthItem
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = translate('Roles');
Yii::$app->params['breadcrumbs'][] = $this->title;
$form = ActiveForm::begin(['action' => ['role/update']]);
?>
<div class="row">
    <?php foreach ($roles as $role):
        $rolePermissions = $role->getChildren()->select('name')->asArray()->all();
        ?>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Role: <b><?= $role->name ?></b>
                </div>
                <div class="card-body">
                    <?= Html::checkboxList(
                        'roles[' . $role->name . ']',
                        array_column($rolePermissions, 'name'),
                        array_column($permissions, 'name', 'name'),
                        [
                            'tag' => 'div',
                            'class' => 'row'
                        ]
                    ) ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<div class="card card-footer">
    <?= Html::submitButton(translate("Save"), ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>
