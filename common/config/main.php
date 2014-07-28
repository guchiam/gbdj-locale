<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'sourceLanguage' => 'en',
    'language' => 'en',
    'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],
        'i18n' => [
            'translations' => [
                'pages' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'sourceLanguage' => 'en',
                    'basePath' => '@backend/modules/pages/messages',
                ],
            ]
        ],
    ],
    'modules' => [
        'auth' => [
            'class' => 'auth\Module',
            'layout' => '//main', // Optional
            'layoutLogged' => '//main', // Optional
            'attemptsBeforeCaptcha' => 3, // Optional
            'superAdmins' => ['admin'], // Recommended
            'tableMap' => [ // Optional, but if defined, all must be declared
                'User' => 'user',
                'UserStatus' => 'user_status',
                'ProfileFieldValue' => 'profile_field_value',
                'ProfileField' => 'profile_field',
                'ProfileFieldType' => 'profile_field_type',
            ],

        ],
    ],
];
