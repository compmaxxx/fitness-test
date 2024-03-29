<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'timeZone' => 'Asia/Bangkok',
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'scGM_SqxIXX18_ccw5Rmg42DMveHam4r',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
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
        'urlManager' => [
          'enablePrettyUrl' => true,
          'enableStrictParsing' => false,
          'showScriptName' => false,
          'rules' => [
              '<controller:\w+>/<action\w+>/<id:\d+>'=>'<controller>/<action>',
              '<controller:\w+>/<id:\d+>'=>'<controller>/view',
              '<controller:\w+>/<action\w+>'=>'<controller>/<action>',
              ['class' => 'yii\rest\UrlRule', 'controller' => 'course-rest', 'pluralize' => false],
              ['class' => 'yii\rest\UrlRule', 'controller' => 'result-rest', 'pluralize' => false],
              ['class' => 'yii\rest\UrlRule', 'controller' => 'test-rest', 'pluralize' => false],
          ],
        ],

    ],
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module',
            'downloadAction' => 'gridview/export/download',
        ]
    ],
    'params' => $params,
    'defaultRoute' => 'course/index',
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
