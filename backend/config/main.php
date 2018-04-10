<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        //2018 3.5
        'admin' => [        
            'class' => 'mdm\admin\Module',   
        ],
    ],
    //2018 3.5
    'aliases' => [    
        '@mdm/admin' => '@vendor/mdmsoft/yii2-admin',
    ],
    //2018 3.5
    'as access' => [
        'class' => 'mdm\admin\components\AccessControl',
        'allowActions' => [
            //这里是允许访问的action，不受权限控制
            //controller/action
            // '*',//所有控制器都不受rbac控制
            'site/*',
            'category/*',
            'test/*',
            'event-test/*',
            'send-mail/*',
            'debug/*',
            'blog/test-db',
        ]
    ],
    //2018 3.1 添加，用于配置来限定行为的有效性
    // 'as myBehavior2' => backend\components\MyBehavior::className(),
    // 'as access' => backend\components\AccessControl::className(),
    //2018 3.6 测试切换主题，配置行为
    'as theme' => [
            'class' => 'backend\components\ThemeControl',
        ],
    'components' => [
        //2018 3.6
        /*'view' => [
            'theme' => [
                // 'basePath' => '@app/themes/spring', 资源的目录
                // 'baseUrl' => '@web/themes/spring', 资源的url
                'pathMap' => [ 
                    //对@app/view路径替换为@app/themes/spring
                    '@app/views' => [ 
                        '@app/themes/christmas',
                        '@app/themes/spring',
                    ]
                ],
            ],
        ],*/
        //2018 3.14 路由美化
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                // '/blogs/<id:\d+>' => '/blog/view',
                // '/blogs' => '/blog/index',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<controller:\w+>/<id:\d+>' => '<controller>/view',
                '<controller:\w+>/<action:\w+>/<page:\d+>' => '<controller>/<action>',
            ],
        ],
        //2018 3.5
        'authManager' => [        
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],    
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'backend\models\UserBackend',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
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
            'errorAction' => 'site/error',
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
        'assetManager' => [
            'bundles' => [
                'dmstr\web\AdminLteAsset' => [
                    'skin' => 'skin-purple-light',
                ],
            ],
        ],
    ],
    'params' => $params,
];
