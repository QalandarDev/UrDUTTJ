<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%shartnoma}}`.
 */
class m220110_054821_create_shartnoma_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ttj.shartnoma}}', [
            'id' => $this->primaryKey(),
            'number'=>$this->bigInteger(),
            '_student' => $this->integer(),
            '_pdf'=>$this->integer(),
            '_xona'=>$this->integer(),
            'status' =>$this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'created_by' => $this->integer(),
            'updated_by'=>$this->integer()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%shartnoma}}');
    }
}
