<?php

use yii\db\Migration;

/**
 * Class m211029_043043_mac_bot
 */
class m211029_043043_create_table_bot_darsjadval extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%bot.darsjadval}}',
            [
                'UserID' => $this->primaryKey(),
                'FirstName' => $this->string(45),
            ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%bot.darsjadval}}');
    }


}
