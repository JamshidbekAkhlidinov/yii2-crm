<?php
/*
 *   Jamshidbek Akhlidinov
 *   29 - 11 2023 18:26:26
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov/yii2basic
 */

namespace app\components\menu;

use app\modules\admin\enums\UserRolesEnum;
use app\modules\admin\widgets\MenuWidget;

class Menu
{
    public static function getMenu()
    {
        return MenuWidget::widget([
            'items' => [
                [
                    'label' => 'Main Menus',
                    'type' => MenuWidget::type_title, //menu,item
                    'icon' => 'ri-dashboard-2-line',
                ],
                [
                    'label' => translate("Main"),
                    'type' => MenuWidget::type_item, //menu,item
                    'icon' => 'fa fa-home',
                    'url' => ['/site/index'],
                    'active' => controller()->route == 'site/index',
                ],
                [
                    'label' => translate("About"),
                    'type' => MenuWidget::type_item, //menu,item
                    'icon' => 'ri-checkbox-multiple-fill',
                    'url' => ['/site/about'],
                    'active' => controller()->route == 'site/about',
                ],

                [
                    'label' => translate("Auth"),
                    'type' => MenuWidget::type_item, //menu,item
                    'icon' => 'ri-user-2-line',
                    'id' => 'categoryList',
                    'items' => [
                        [
                            'label' => translate("Login"),
                            'url' => ['/auth/login'],
                            'icon' => 'ri-dashboard-2-line',
                            'visible' => user()->isGuest
                        ],
                        [
                            'label' => translate("Signup"),
                            'url' => ['/auth/signup'],
                            'icon' => 'ri-dashboard-2-line',
                            'visible' => user()->isGuest
                        ],
                        [
                            'label' => translate("New Post"),
                            'type' => MenuWidget::type_item, //menu,item
                            'icon' => 'ri-checkbox-multiple-fill',
                            'url' => ['/site/new-post'],
                            'active' => controller()->route == 'site/new-post',
                        ],
                        [
                            'label' => translate("Advertise"),
                            'type' => MenuWidget::type_item, //menu,item
                            'icon' => 'ri-checkbox-multiple-fill',
                            'url' => ['/advertise'],
                            'active' => controller()->id == 'advertise',
                        ],
                        [
                            'label' => translate("Profile"),
                            'url' => can(UserRolesEnum::ROLE_USER) ? ['/user/profile'] : ['/admin'],
                            'icon' => 'ri-dashboard-2-line',
                            'visible' => !user()->isGuest,
                            'active' => controller()->route == 'user/profile',
                        ],
                        [
                            'label' => translate("Logout"),
                            'url' => ['/auth/logout'],
                            'icon' => 'ri-dashboard-2-line',
                            'visible' => !user()->isGuest
                        ],
                    ],
                ],
            ]
        ]);
    }

}