<?php

use yii\db\Migration;

/**
 * Handles the creation of table `category`.
 */
class m180306_060952_create_category_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 ENGINE=InnoDB';
        }

        $this->createTable('category', [
            'id' => $this->primaryKey()->comment('栏目ID'),
            'name' => $this->string('20')->notNull()->defaultValue('')->comment('栏目名'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('category');
    }
}
