<?php
/*
 *   Jamshidbek Akhlidinov
 *   4 - 3 2025 11:58:39
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\modules\admin\modules\rbac\controllers;

use app\modules\admin\modules\rbac\models\AuthItem;
use Yii;
use yii\rbac\Role;
use yii\web\Controller;

class RoleController extends Controller
{
    public function actionIndex()
    {
        $roles = AuthItem::find()
            ->andWhere(['type' => Role::TYPE_ROLE])
            ->all();
        $permissions = AuthItem::find()
            ->andWhere(['type' => Role::TYPE_PERMISSION])
            ->all();

        return $this->render('index', [
            'roles' => $roles,
            'permissions' => $permissions
        ]);
    }

    public function actionUpdate()
    {
        $roles = Yii::$app->request->post('roles');
        $auth = Yii::$app->authManager;
        foreach ($roles as $role => $permissions) {
            $roleModel = $auth->getRole($role);
            $auth->removeChildren($roleModel);
            foreach ($permissions as $permission) {
                $permissionModel = $auth->getPermission($permission);
                $auth->addChild($roleModel, $permissionModel);
            }
        }
        session()->setFlash(
            'alert',
            [
                'body' => translate("Saved"),
                'options' => ['class' => 'alert alert-success']
            ]
        );
        return $this->redirect(['role/index']);
    }
}