<?php

namespace backend\models;

use Yii;
use yii\helpers\ArrayHelper;
use backend\models\BlogCategory;
use backend\models\Category;

/**
 * This is the model class for table "blog".
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property int $views
 * @property int $is_delete
 * @property string $create_at
 * @property string $update_at
 */
class Blog extends \yii\db\ActiveRecord
{

    //添加category表属性
    public $category;
    /**
     * 获取栏目的枚举值，
     * key=>value的形式组合:key表示栏目ID,value表示栏目名称
     */
    public static function dropDownList ($params)
    {
        $query = static::find();
        $enums = $query->all();
        return $enums ? ArrayHelper::map($enums, 'id', $params) : [];
    }

    public function getCategory()
    {
        return $this->hasMany(Category::className(), ['id' => 'category_id'])->viaTable(BlogCategory::tableName(), ['blog_id' => 'id']);
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'blog';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'category', 'create_at', 'update_at'], 'required'],
            [['content'], 'string'],
            [['views'], 'integer'],
            [['create_at', 'update_at'], 'safe'],
            [['title'], 'string', 'max' => 100],
            [['is_delete'], 'string', 'max' => 4],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '主键',
            'title' => '标题',
            'content' => '内容',
            'views' => '浏览',
            'is_delete' => '是否删除',
            'category' => '栏目',
            'create_at' => '创建时间',
            'update_at' => '更新时间',
        ];
    }
}
