<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%xona}}`.
 */
class m220106_055034_create_xona_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ttj.xona}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            '_parent' => $this->integer(),
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
        $this->dropTable('{{%xona}}');
    }
}
