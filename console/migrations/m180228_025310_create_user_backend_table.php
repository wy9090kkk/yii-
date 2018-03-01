<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user_backend`.
 */
class m180228_025310_create_user_backend_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user_backend', [
            'id' => $this->primaryKey(),
            'username' => $this->string(255)->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string(255)->notNull(),
            // 'password_reset_token' => $this->string()->unique(),
            'email' => $this->string(255)->notNull()->unique(),

            // 'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->datetime()->notNull(),
            'updated_at' => $this->datetime()->notNull(),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('user_backend');
    }
}
