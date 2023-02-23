<?php

return [
    'request' => [
        'csrfParam' => '_csrf-backend',
    ],
    'user' => [
        'identityClass' => 'common\models\User',
        'enableAutoLogin' => true,
        'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        'loginUrl' => ['guest/login'],
    ],
    'session' => [
        // this is the name of the session cookie used for login on the backend
        'name' => 'advanced-backend',
    ],
    'log' => [
        'traceLevel' => YII_DEBUG ? 3 : 0,
        'targets' => [
            [
                'class' => 'yii\log\FileTarget',
                'levels' => ['error', 'warning'],
            ],
        ],
    ],
    'errorHandler' => [
        'errorAction' => 'main/error',
    ],
    'urlManager' => [
        'enablePrettyUrl' => true,
        'showScriptName' => false,
        'rules' => [
            '<_a:error>' => 'main/<_a>',
            '<_a:logout>' => 'main/<_a>',            
            '<_a:(login|signup|confirm-email|request-password-reset|reset-password)>' => 'guest/<_a>',            
            '<_a:login-validate>' => 'guest/<_a>',

            // '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>' => '<_m>/<_c>/view',
            // '<_m:[\w\-]+>/<_c:[\w\-]+>/<id:\d+>/<_a:[\w\-]+>' => '<_m>/<_c>/<_a>',
            // '<_m:[\w\-]+>' => '<_m>/default/index',
            // '<_m:[\w\-]+>/<_c:[\w\-]+>' => '<_m>/<_c>/index',
        ],
    ],
    'i18n' => [
        'translations' => [
            '*' => [        
                'class' => 'backend\components\i18n\DbMessageSourceLocale',
                'on missingTranslation' => ['backend\components\i18n\TranslationEventHandler', 'handleMissingTranslation'],
                'enableCaching' => true,
                'cachingDuration' => 86400
                // 'forceTranslation' => true,
            ]
        ],
    ],
];
