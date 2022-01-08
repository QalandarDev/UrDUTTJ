<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pdf}}`.
 */
class m220106_054241_create_pdf_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%ttj.pdf}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'link' => $this->string(),
            'status'=>$this->integer(),
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
        $this->dropTable('{{%pdf}}');
    }
}
