<?php

use App\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => '1111',
                'title' => 'user_management_access',
            ],
            [
                'id'    => '1112',
                'title' => 'permission_create',
            ],
            [
                'id'    => '1113',
                'title' => 'permission_edit',
            ],
            [
                'id'    => '1114',
                'title' => 'permission_show',
            ],
            [
                'id'    => '1115',
                'title' => 'permission_delete',
            ],
            [
                'id'    => '1116',
                'title' => 'permission_access',
            ],
            [
                'id'    => '1117',
                'title' => 'role_create',
            ],
            [
                'id'    => '1118',
                'title' => 'role_edit',
            ],
            [
                'id'    => '1119',
                'title' => 'role_show',
            ],
            [
                'id'    => '11110',
                'title' => 'role_delete',
            ],
            [
                'id'    => '11111',
                'title' => 'role_access',
            ],
            [
                'id'    => '11112',
                'title' => 'user_create',
            ],
            [
                'id'    => '11113',
                'title' => 'user_edit',
            ],
            [
                'id'    => '11114',
                'title' => 'user_show',
            ],
            [
                'id'    => '11115',
                'title' => 'user_delete',
            ],
            [
                'id'    => '11116',
                'title' => 'user_access',
            ],
            [
                'id'    => '11117',
                'title' => 'message_access',
            ],
            [
                'id'    => '11118',
                'title' => 'notification_create',
            ],
            [
                'id'    => '11119',
                'title' => 'notification_edit',
            ],
            [
                'id'    => '11120',
                'title' => 'notification_show',
            ],
            [
                'id'    => '11121',
                'title' => 'notification_delete',
            ],
            [
                'id'    => '11122',
                'title' => 'notification_access',
            ],
            [
                'id'    => '11123',
                'title' => 'advertising_space_create',
            ],
            [
                'id'    => '11124',
                'title' => 'advertising_space_edit',
            ],
            [
                'id'    => '11125',
                'title' => 'advertising_space_show',
            ],
            [
                'id'    => '11126',
                'title' => 'advertising_space_delete',
            ],
            [
                'id'    => '11127',
                'title' => 'advertising_space_access',
            ],
            [
                'id'    => '11128',
                'title' => 'setting_create',
            ],
            [
                'id'    => '11129',
                'title' => 'setting_edit',
            ],
            [
                'id'    => '11130',
                'title' => 'setting_show',
            ],
            [
                'id'    => '11131',
                'title' => 'setting_delete',
            ],
            [
                'id'    => '11132',
                'title' => 'setting_access',
            ],
            [
                'id'    => '11133',
                'title' => 'category_type_create',
            ],
            [
                'id'    => '11134',
                'title' => 'category_type_edit',
            ],
            [
                'id'    => '11135',
                'title' => 'category_type_show',
            ],
            [
                'id'    => '11136',
                'title' => 'category_type_delete',
            ],
            [
                'id'    => '11137',
                'title' => 'category_type_access',
            ],
            [
                'id'    => '11138',
                'title' => 'category_create',
            ],
            [
                'id'    => '11139',
                'title' => 'category_edit',
            ],
            [
                'id'    => '11140',
                'title' => 'category_show',
            ],
            [
                'id'    => '11141',
                'title' => 'category_delete',
            ],
            [
                'id'    => '11142',
                'title' => 'category_access',
            ],
            [
                'id'    => '11143',
                'title' => 'sub_domian_create',
            ],
            [
                'id'    => '11144',
                'title' => 'sub_domian_edit',
            ],
            [
                'id'    => '11145',
                'title' => 'sub_domian_show',
            ],
            [
                'id'    => '11146',
                'title' => 'sub_domian_delete',
            ],
            [
                'id'    => '11147',
                'title' => 'sub_domian_access',
            ],
            [
                'id'    => '11148',
                'title' => 'image_create',
            ],
            [
                'id'    => '11149',
                'title' => 'image_edit',
            ],
            [
                'id'    => '11150',
                'title' => 'image_show',
            ],
            [
                'id'    => '11151',
                'title' => 'image_delete',
            ],
            [
                'id'    => '11152',
                'title' => 'image_access',
            ],
            [
                'id'    => '11153',
                'title' => 'images_management_access',
            ],
            [
                'id'    => '11154',
                'title' => 'comment_create',
            ],
            [
                'id'    => '11155',
                'title' => 'comment_edit',
            ],
            [
                'id'    => '11156',
                'title' => 'comment_show',
            ],
            [
                'id'    => '11157',
                'title' => 'comment_delete',
            ],
            [
                'id'    => '11158',
                'title' => 'comment_access',
            ],
            [
                'id'    => '11159',
                'title' => 'like_create',
            ],
            [
                'id'    => '11160',
                'title' => 'like_edit',
            ],
            [
                'id'    => '11161',
                'title' => 'like_show',
            ],
            [
                'id'    => '11162',
                'title' => 'like_delete',
            ],
            [
                'id'    => '11163',
                'title' => 'like_access',
            ],
            [
                'id'    => '11164',
                'title' => 'favorite_create',
            ],
            [
                'id'    => '11165',
                'title' => 'favorite_edit',
            ],
            [
                'id'    => '11166',
                'title' => 'favorite_show',
            ],
            [
                'id'    => '11167',
                'title' => 'favorite_delete',
            ],
            [
                'id'    => '11168',
                'title' => 'favorite_access',
            ],
            [
                'id'    => '11169',
                'title' => 'sound_create',
            ],
            [
                'id'    => '11170',
                'title' => 'sound_edit',
            ],
            [
                'id'    => '11171',
                'title' => 'sound_show',
            ],
            [
                'id'    => '11172',
                'title' => 'sound_delete',
            ],
            [
                'id'    => '11173',
                'title' => 'sound_access',
            ],
            [
                'id'    => '11174',
                'title' => 'video_create',
            ],
            [
                'id'    => '11175',
                'title' => 'video_edit',
            ],
            [
                'id'    => '11176',
                'title' => 'video_show',
            ],
            [
                'id'    => '11177',
                'title' => 'video_delete',
            ],
            [
                'id'    => '11178',
                'title' => 'video_access',
            ],
            [
                'id'    => '11179',
                'title' => 'adminmenu_create',
            ],
            [
                'id'    => '11180',
                'title' => 'adminmenu_edit',
            ],
            [
                'id'    => '11181',
                'title' => 'adminmenu_show',
            ],
            [
                'id'    => '11182',
                'title' => 'adminmenu_delete',
            ],
            [
                'id'    => '11183',
                'title' => 'adminmenu_access',
            ],
            [
                'id'    => '11184',
                'title' => 'seo_create',
            ],
            [
                'id'    => '11185',
                'title' => 'seo_edit',
            ],
            [
                'id'    => '11186',
                'title' => 'seo_show',
            ],
            [
                'id'    => '11187',
                'title' => 'seo_delete',
            ],
            [
                'id'    => '11188',
                'title' => 'seo_access',
            ],
            [
                'id'    => '11189',
                'title' => 'admin_create',
            ],
            [
                'id'    => '11190',
                'title' => 'admin_edit',
            ],
            [
                'id'    => '11191',
                'title' => 'admin_show',
            ],
            [
                'id'    => '11192',
                'title' => 'admin_delete',
            ],
            [
                'id'    => '11193',
                'title' => 'admin_access',
            ],
            [
                'id'    => '11194',
                'title' => 'contact_us_message_create',
            ],
            [
                'id'    => '11195',
                'title' => 'contact_us_message_edit',
            ],
            [
                'id'    => '11196',
                'title' => 'contact_us_message_show',
            ],
            [
                'id'    => '11197',
                'title' => 'contact_us_message_delete',
            ],
            [
                'id'    => '11198',
                'title' => 'contact_us_message_access',
            ],
            [
                'id'    => '11199',
                'title' => 'radio_create',
            ],
            [
                'id'    => '111100',
                'title' => 'radio_edit',
            ],
            [
                'id'    => '111101',
                'title' => 'radio_show',
            ],
            [
                'id'    => '111102',
                'title' => 'radio_delete',
            ],
            [
                'id'    => '111103',
                'title' => 'radio_access',
            ],
        ];

        Permission::insert($permissions);
    }
}
