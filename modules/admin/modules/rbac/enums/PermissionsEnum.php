<?php
/*
 *   Jamshidbek Akhlidinov
 *   7 - 3 2025 8:58:32
 *   https://ustadev.uz
 *   https://github.com/JamshidbekAkhlidinov
 */

namespace app\modules\admin\modules\rbac\enums;

interface PermissionsEnum
{
    public const page_view = 'page_view';
    public const page_create = 'page_create';
    public const page_update = 'page_update';
    public const page_delete = 'page_delete';

    public const category_view = 'category_view';
    public const category_create = 'category_create';
    public const category_update = 'category_update';
    public const category_delete = 'category_delete';

    public const tag_view = 'tag_view';
    public const tag_create = 'tag_create';
    public const tag_update = 'tag_update';
    public const tag_delete = 'tag_delete';

    public const post_view = 'post_view';
    public const post_create = 'post_create';
    public const post_update = 'post_update';
    public const post_delete = 'post_delete';

    public const file_manager_view = 'file_manager_view';
    public const file_manager_upload = 'file_manager_upload';
    public const file_manager_delete = 'file_manager_delete';

    public const i18n_view = 'i18n_view';
    public const i18n_update = 'i18n_update';

    public const user_view = 'user_view';
    public const user_create = 'user_create';
    public const user_update = 'user_update';
    public const user_delete = 'user_delete';

    public const role_view = 'role_view';
    public const role_create = 'role_create';
    public const role_update = 'role_update';
    public const role_delete = 'role_delete';

    public const list = [
        self::page_view, self::page_create, self::page_update, self::page_delete,
        self::category_view, self::category_create, self::category_update, self::category_delete,
        self::tag_view, self::tag_create, self::tag_update, self::tag_delete,
        self::post_view, self::post_create, self::post_update, self::post_delete,
        self::file_manager_view, self::file_manager_upload, self::file_manager_delete,
        self::i18n_view, self::i18n_update,
        self::user_view, self::user_create, self::user_update, self::user_delete,
        self::role_view, self::role_create, self::role_update, self::role_delete,
    ];
}
