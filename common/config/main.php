<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
    	// 配置缓存
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        // 配置数据库
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=testlearn',
            'username' => 'root',
            'password' => '123456',
            'charset' => 'utf8',
            'enableSchemaCache' => true,
            'schemaCacheDuration' => 24*3600,
            'schemaCache' => 'cache',
        ],
        // 自定义的公用配置
        'helper' => [
        	'class' => 'common\components\Helper',
        	'property' => '123',
        ],

        //authManager有PhpManager和DbManager两种方式,    
        //PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库.    
        "authManager" => [        
            "class" => 'yii\rbac\DbManager',
        ],
    ],
    // 配置语言
    'language'=>'zh-CN',
    // 配置时区
    'timeZone'=>'Asia/Shanghai',
];
