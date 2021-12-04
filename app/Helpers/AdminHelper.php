<?php

namespace App\Helpers;

class AdminHelper
{

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
                'key' => 't-category',
                'route' => 'admin.subcategory.add',
                'icon' => 'bx bx-spreadsheet',
                'label' => 'Category'
            ],
            [
                'key' => 't-contact-form-submissions',
                'route' => 'admin.contact-form-submissions',
                'icon' => 'bx bx-envelope',
                'label' => 'Contact Form Submissions'
            ],
            [
                'key' => 't-ad-reports-submissions',
                'route' => 'admin.advertisement-reports',
                'icon' => 'bx bx-spreadsheet',
                'label' => 'Reported Ad Submissions'
            ],
            [
                'key' => 't-user-block-options',
                'route' => 'admin.user-view-options',
                'icon' => 'bx bx-spreadsheet',
                'label' => 'Block Users'
            ]
        ];
    }
}
