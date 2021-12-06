<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bot_anticor}}`.
 */
class m211129_123148_create_bot_anticor_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bot.anticor}}', [
            'UserID' => $this->primaryKey(),
            'FirstName' => $this->string(45),
            'Step'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bot_anticor}}');
    }
}
