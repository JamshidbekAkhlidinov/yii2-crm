<?php

namespace app\modules\admin\modules\content;

use app\modules\admin\enums\UserRolesEnum;
use app\modules\admin\modules\rbac\enums\PermissionsEnum;
use Yii;
use yii\web\ForbiddenHttpException;

/**
 * content module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\modules\content\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }

    public function beforeAction($action)
    {
        $user = Yii::$app->user;

        if ($user->can(UserRolesEnum::ROLE_ADMINISTRATOR)) {
            return parent::beforeAction($action);
        }

        $controller = Yii::$app->controller->id;
        $actionId = $action->id;

        $permissionMap = [
            'page' => [
                'index' => PermissionsEnum::page_view,
                'create' => PermissionsEnum::page_create,
                'update' => PermissionsEnum::page_update,
                'delete' => PermissionsEnum::page_delete,
            ],
            'post-category' => [
                'index' => PermissionsEnum::category_view,
                'create' => PermissionsEnum::category_create,
                'update' => PermissionsEnum::category_update,
                'delete' => PermissionsEnum::category_delete,
            ],
            'post-tag' => [
                'index' => PermissionsEnum::tag_view,
                'create' => PermissionsEnum::tag_create,
                'update' => PermissionsEnum::tag_update,
                'delete' => PermissionsEnum::tag_delete,
            ],
            'post' => [
                'index' => PermissionsEnum::post_view,
                'create' => PermissionsEnum::post_create,
                'update' => PermissionsEnum::post_update,
                'delete' => PermissionsEnum::post_delete,
            ],
        ];

        if (isset($permissionMap[$controller])) {
            $permissions = $permissionMap[$controller];
            if (isset($permissions[$actionId]) && !$user->can($permissions[$actionId])) {
                throw new ForbiddenHttpException('Sizga ushbu amalni bajarish taqiqlangan.') ;
            }
        }

        return parent::beforeAction($action);
    }
}
