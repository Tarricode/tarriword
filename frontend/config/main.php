<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'name'=>"TarriWord",
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'view' => [
        'theme' => [
        'basePath' => '@app/themes/basic',
        'pathMap' => ['@app/views' => '@app/themes/basic/views'], 
        'baseUrl' => '@web/themes/basic',
        ],
        ],
        'authClientCollection' => [
                  'class' => 'yii\authclient\Collection',
                  'clients' => [
                      'facebook' => [
                          'class' => 'yii\authclient\clients\Facebook',
                          'authUrl' => 'https://www.facebook.com/dialog/oauth?display=popup',
                          'clientId' => '207554783321486',
                          'clientSecret' => 'f6d62a137b8aa00a65106ffacdfc25a3',
                        ],
                  ],
              ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
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
            'errorAction' => 'site/error',
        ],
        
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => true,
            'rules' => [
            ],
        ],
        
    ],
    'modules'=>[
      'pdfjs' => [
           'class' => '\yii2assets\pdfjs\Module',
       ],
    ],
    'params' => $params,
];
