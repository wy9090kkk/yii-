<?php

namespace backend\models;

use Yii;

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
            [['content', 'create_at', 'update_at'], 'required'],
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
            'id' => 'ID',
            'title' => 'Title',
            'content' => 'Content',
            'views' => 'Views',
            'is_delete' => 'Is Delete',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
        ];
    }
}
