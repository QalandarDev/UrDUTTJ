<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%ariza}}`.
 */
class m220106_054715_create_ariza_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ttj.ariza}}', [
            'id' => $this->primaryKey(),
            '_student'=>$this->integer(),
            'about'=>$this->string(),
            'answer'=>$this->string(),
            'status'=>$this->integer(),
            '_pdf'=>$this->integer()->unique(),
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
        $this->dropTable('{{%ariza}}');
    }
}
