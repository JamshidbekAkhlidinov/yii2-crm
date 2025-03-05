<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_token}}`.
 */
class m250305_070241_create_user_token_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_token}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'type' => $this->string()->notNull(),
            'token' => $this->string(40)->notNull(),
            'expire_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user_token}}');
    }
}
