<?php

use yii\db\Migration;

/**
 * Handles the creation of table `blog`.
 */
class m180228_135812_create_blog_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('blog', [
            'id' => $this->primaryKey(),
            'title' => $this->string(100)->notNull()->defaultValue(''),
            'content' => $this->text()->notNull(),
            'views' => $this->integer(11)->notNull()->defaultValue('0'),
            'is_delete' => $this->tinyinteger(4)->notNull()->defaultValue('1'),
            'create_at' => $this->datetime()->notNull(),
            'update_at' => $this->datetime()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('blog');
    }
}
