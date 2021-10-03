<?php

namespace App\Helpers;

class AdminHelper {

    public static function getAdminSidebarLinks()
    {
        return [
            [
                'key' => 't-dashboards',
                'route' => 'root',
                'icon' => 'bx bx-home-circle',
                'label' => 'Dashboard',
            ],
            [
                'key' => 't-category-options',
                'route' => 'admin.option-groups.add',
                'icon' => 'bx bx-spreadsheet',
                'label' => 'Category Option Groups',
            ],
            [
                'key'=> 't-category',
                'route'=> 'admin.subcategory.add',
                'icon'=> 'bx bx-spreadsheet',
                'label'=> 'Category'
            ]
        ];
    }

}
