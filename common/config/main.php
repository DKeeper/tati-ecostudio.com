<?php
return [
    'language' => 'ru_RU',
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'class' => 'amnah\yii2\user\components\User',
        ],
        'mobiledetect' => [
            'class' => 'dkeeper\mobiledetect\Detect',
        ],
        'mail' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'], // this is needed for sending emails
                'charset' => 'UTF-8',
            ]
        ],
        'i18n'=>[
            'translations' => [
                'view'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@common/messages",
                    'sourceLanguage' => 'en_US',
                    'fileMap' => [
                        'view'=>'view.php',
                    ]
                ],
                'model'=>[
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => "@common/messages",
                    'sourceLanguage' => 'en_US',
                    'fileMap' => [
                        'model'=>'model.php',
                    ]
                ],
            ]
        ],
        'request' => [
            'cookieValidationKey' => 'wWx0Lt8FglIuE6C32JHn',
        ]
    ],
    'modules' => [
        'user' => [
            'class' => 'amnah\yii2\user\Module',
            // set custom module properties here ...
        ],
    ],
];
