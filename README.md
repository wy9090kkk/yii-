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
    4 RBAC的实现
        1） 分析
            (a) 首先主体，也就是用户，需要有一张用户表，很简单，我们已经有了，就是数据表 user_backend
            (b) 我们需要有一张角色表和权限表，分别存放角色和权限的数据表
            (c) 另外我们还需要一张主体跟角色的关联表，也就是需要给用户分配角色的存储表
            (d) 最后我们再需要一张角色跟权限的关联表
        2) yii内部已经将一部分代码预写好了，只需要利用  ./yii migrate --migrationPath=@yii/rbac/migrations/命令，即可实现数据表的创建auth_assignment（用户-角色的关联表） auth_item（用于存储角色、权限和路由） auth_item_child（角色-权限的关联表） auth_rule
            notice* : 在使用上述命令时需要先在common\config\main.php中进行相关配置，在 components 数组中加入 authManager 组件（authManager有PhpManager和DbManager两种方式,PhpManager将权限关系保存在文件里,这里使用的是DbManager方式,将权限关系保存在数据库）
        3） 在backend\controllers下创建一个RbacController类来做权限，角色的初始化
        4） 在对应的控制器的操作中，加入Yii::$app->user->can('/blog/index')来判断是否有权限访问，没有就抛出异常，这样便实现了RBAC的访问控制
            notice* ： 如果存在很多控制器的情况，那么会变得很麻烦，因为要先对所有的控制器和方法进行初始化，还要依次打开每个控制器对每个操作进行判断操作，会十分麻烦
        5） 利用一个方法来解决对所有操作都做判断的问题，beforeAction方法（在执行action之前，yii2内部会先执行一个叫 beforeAction 的操作）这样会节省很多代码，但是还是会很麻烦，还是要打开每一个控制器去写beforeAction
        6） 行为的概念
            a） 官方概念：行为是 yii\base\Behavior 或其子类的实例。 行为，也称为 mixins， 可以无须改变类继承关系即可增强一个已有的 yii\base\Component 类功能。 当行为附加到组件后，它将“注入”它的方法和属性到组件，然后可以像访问组件内定义的方法和属性一样访问它们。 此外，行为通过组件能响应被触发的事件， 从而自定义或调整组件正常执行的代码。
            b） 概括： 实质就是一个类（yii\base\Behavior 或其子类的实例），通过某些特殊方式（注入，绑定），同另一个类（yii\base\Component 或其子类的实例）进行了绑定，然后二者可以进行交互。这句话你可以多看两遍，最后心里先明白，谁和谁绑定了。
        7） 利用行为来解决RBAC的问题
            a） 在backend/components下创建一个行为类（AccessControl）
                1） 方法一 ： beforeAction方法，用来在其余控制器中生效，来影响访问前的预处理
                2） 方法二 ： denyAccess方法，用来拒绝访问，抛出异常
            b） 将行为类配置到backend/config/main.php中，