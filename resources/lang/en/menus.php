<?php

return [

/*
|--------------------------------------------------------------------------
| Menus Language Lines
|--------------------------------------------------------------------------
|
| The following language lines are used in menu items throughout the system.
| Regardless where it is placed, a menu item can be listed here so it is easily
| found in a intuitive way.
|
*/

'backend' => [
   'management' => [
      'inventory' => [
         'title'  => 'Inventory Management',
         'asset'  => [
            'title'  => 'Asset Management',
            'all'    => 'View Assets',
            'create' => 'Create Asset',
            'edit'   => 'Edit Asset',
            'deleted'   => 'Deleted Assets'
         ],

         'category'  => [
            'title'  => 'Category Management',
            'all'    => 'View Categories',
            'create' => 'Create Category',
            'edit'   => 'Edit Category',
            'deleted'   => 'Deleted Categories'
         ],
      ]
   ],

   'access' => [
      'title' => 'Access Management',

      'roles' => [
            'all'        => 'All Roles',
            'create'     => 'Create Role',
            'edit'       => 'Edit Role',
            'management' => 'Role Management',
            'main'       => 'Roles',
      ],

      'users' => [
            'all'             => 'All Users',
            'change-password' => 'Change Password',
            'create'          => 'Create User',
            'deactivated'     => 'Deactivated Users',
            'deleted'         => 'Deleted Users',
            'edit'            => 'Edit User',
            'main'            => 'Users',
            'view'            => 'View User',
      ],
   ],

   'log-viewer' => [
      'main'      => 'Log Viewer',
      'dashboard' => 'Dashboard',
      'logs'      => 'Logs',
   ],

   'sidebar' => [
      'dashboard' => 'Dashboard',
      'management'=> [
         'inventory' => [
            'asset'  => 'Asset Management',
            'category'  => 'Category Management'
         ]
      ],
      'general'   => 'General',
      'system'    => 'System',
   ],
],

   'language-picker' => [
      'language' => 'Language',
      /*
      * Add the new language to this array.
      * The key should have the same language code as the folder name.
      * The string should be: 'Language-name-in-your-own-language (Language-name-in-English)'.
      * Be sure to add the new language in alphabetical order.
      */
      'langs' => [
            'ar'    => 'Arabic',
            'zh'    => 'Chinese Simplified',
            'zh-TW' => 'Chinese Traditional',
            'da'    => 'Danish',
            'de'    => 'German',
            'el'    => 'Greek',
            'en'    => 'English',
            'es'    => 'Spanish',
            'fr'    => 'French',
            'id'    => 'Indonesian',
            'it'    => 'Italian',
            'ja'    => 'Japanese',
            'nl'    => 'Dutch',
            'pt_BR' => 'Brazilian Portuguese',
            'ru'    => 'Russian',
            'sv'    => 'Swedish',
            'th'    => 'Thai',
            'tr'    => 'Turkish',
      ],
   ],
];
