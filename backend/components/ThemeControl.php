<?php

namespace backend\components;

use Yii;
use yii\base\Object;

class ThemeControl extends \yii\base\ActionFilter
{
    public function init ()
    {
        $switch = intval(Yii::$app->request->get('switch'));
        // var_dump($switch);die();
        $theme = $switch ? 'spring' : 'christmas';
        // var_dump($theme);die();l;;l
        Yii::$app->view->theme = Yii::createObject([
            'class' => 'yii\base\Theme',
            'pathMap' => [ 
                '@app/views' => [ 
                    "@app/themes/{$theme}",
                ]
            ],
        ]);
    }
}