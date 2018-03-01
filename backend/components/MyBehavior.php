<?php
namespace backend\components;

use Yii;

class MyBehavior extends \yii\base\ActionFilter
{
    public function beforeAction ($action)
    {
        var_dump(111);
        return true;
    }
    //判断用户是否是访客
    public function isGuest ()
	{
	    return Yii::$app->user->isGuest;
	}
}