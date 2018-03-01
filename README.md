Yii 2 Advanced Project Template
===============================

Yii 2 Advanced Project Template is a skeleton [Yii 2](http://www.yiiframework.com/) application best for
developing complex Web applications with multiple tiers.

The template includes three tiers: front end, back end, and console, each of which
is a separate Yii application.

The template is designed to work in a team development environment. It supports
deploying the application in different environments.

Documentation is at [docs/guide/README.md](docs/guide/README.md).

[![Latest Stable Version](https://poser.pugx.org/yiisoft/yii2-app-advanced/v/stable.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Total Downloads](https://poser.pugx.org/yiisoft/yii2-app-advanced/downloads.png)](https://packagist.org/packages/yiisoft/yii2-app-advanced)
[![Build Status](https://travis-ci.org/yiisoft/yii2-app-advanced.svg?branch=master)](https://travis-ci.org/yiisoft/yii2-app-advanced)

DIRECTORY STRUCTURE
-------------------

```
common
    config/              contains shared configurations
    mail/                contains view files for e-mails
    models/              contains model classes used in both backend and frontend
    tests/               contains tests for common classes    
console
    config/              contains console configurations
    controllers/         contains console controllers (commands)
    migrations/          contains database migrations
    models/              contains console-specific model classes
    runtime/             contains files generated during runtime
backend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains backend configurations
    controllers/         contains Web controller classes
    models/              contains backend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for backend application    
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
frontend
    assets/              contains application assets such as JavaScript and CSS
    config/              contains frontend configurations
    controllers/         contains Web controller classes
    models/              contains frontend-specific model classes
    runtime/             contains files generated during runtime
    tests/               contains tests for frontend application
    views/               contains view files for the Web application
    web/                 contains the entry script and Web resources
    widgets/             contains frontend widgets
vendor/                  contains dependent 3rd-party packages
environments/            contains environment-based overrides
```
YII 学习
一.安装
    1 使用composer来安装，直接敲命令即可实现安装Yii
    2 安装后需要进行相关配置，主要DB配置
二.重点
    1 配置
        1） 跟着教程在common下创建了一个components目录，用于存放自己的组件类
        2） 创建一个自己定义的类 Helpr 并创建一些方法
        3） 在全局的common/config/main.php的companies下配置一下自己创建的类Helper
            'components' => [
                // other code...
                'helper' => [
                    'class' => 'common\components\Helper',
                    'property' => '123',
                ],
            ],
        4） 全局就可以这样调用 Yii::$app->helper->property
        5） 优先级 app/config/main-local.php > app/config/main.php > common\config\main-local.php > common\config\main.php
        6） 在params.php文件中可以配置一些键值对，在全局或特定的模块下就可以使用Yii::$app->params['xxx']来调用
    2 创建后台用户表user_backend 利用yii migrate 和 gii组件创建CURD模块
    3 ACF访问控制过滤器
        1） 在控制器的behaviors方法中，access下添加个'class' => AccessControl::className(),并且在下面rules规定一些规则和操作的名称，便可进行访问控制
    4 