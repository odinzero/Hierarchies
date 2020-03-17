<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'components' => [
        'MenuArrayAL' => [
            'class' => 'app\components\ajacent_list\MenuArrayAL',
        ],
        'BinaryTreeMenuArray' => [
            'class' => 'app\components\binary_tree\BinaryTreeMenuArray',
        ],
        'BSTcheck' => [
            'class' => 'app\components\binary_tree\BSTcheck',
        ],
        'BinaryCell' => [
            'class' => 'app\components\binary_tree\BinaryCell',
        ],
        'MenuArrayMP' => [
            'class' => 'app\components\materialized_path\MenuArrayMP',
        ],
        'MenuArrayJQuery' => [
            'class' => 'app\components\MenuArrayJQuery',
        ],
        'MyCrudOperations' => [
            'class' => 'app\components\CrudOperations',
        ],
        'MyNestedSetComponent' => [
            'class' => 'app\components\MyNestedSetComponent',
        ],
        'MyDbConnection' => [
            'class' => 'app\components\MyDbConnection',
        ],
        'MenuArray' => [
            'class' => 'app\components\MenuArray',
        ],
        'MyMenu' => [
            'class' => 'app\components\Menu',
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'sddsfhsfhhhadgfgfhghghghjhjhfkukukukuktutlt',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
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
        'db' => require(__DIR__ . '/db.php'),
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
