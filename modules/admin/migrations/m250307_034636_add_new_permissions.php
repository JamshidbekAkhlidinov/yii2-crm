<?php

use app\modules\admin\modules\rbac\enums\PermissionsEnum;
use yii\db\Migration;

class m250307_034636_add_new_permissions extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $list = PermissionsEnum::list;
        $auth = Yii::$app->authManager;
        foreach ($list as $permission) {
            try {
                $per = $auth->createPermission($permission);
                $auth->add($per);
            } catch (Exception $exception) {
                print_r($exception->getMessage());
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $list = PermissionsEnum::list;
        $auth = Yii::$app->authManager;
        foreach ($list as $permission) {
            try {
                $per = $auth->getPermission($permission);
                if ($per) {
                    $auth->remove($per);
                }
            } catch (Exception $exception) {
                print_r($exception->getMessage());
            }
        }
    }
}
