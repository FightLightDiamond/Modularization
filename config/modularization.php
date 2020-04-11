<?php
/**
 * Created by cuongpm/modularization.
 * User: vincent
 * Date: 4/29/17
 * Time: 6:20 PM
 */

return [
    'constant' => app_path('Constants'),
    'extends' => 'layouts.app',
    'content' => 'content',
    'extra_css' => 'css',
    'extra_js' => 'js',
    'middleware' => ['web'],

    'black_tables' => [
        'oauth_auth_codes',
        'oauth_access_tokens',
        'oauth_access_token_providers',
        'oauth_personal_access_clients',
        'oauth_clients',
        'oauth_refresh_tokens',
        'password_resets',
        'migrations',
        'jobs',
        'fail_jobs'
    ],

    'test' => [
        'user_account' => [
            'username' => '',
            'password' => ''
        ],
        'admin_account' => [
            'username' => '',
            'password' => ''
        ]
    ]
];
