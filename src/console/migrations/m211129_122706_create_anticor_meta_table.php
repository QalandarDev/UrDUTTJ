<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%anticor_meta}}`.
 */
class m211129_122706_create_anticor_meta_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bot.anticor_meta}}', [
            'UserID'=>$this->primaryKey(),
            'column_1'=>$this->integer(4),
            'column_2'=>$this->integer(4),
            'column_3'=>$this->integer(4),
            'column_4'=>$this->integer(4),
            'column_5'=>$this->integer(4),
            'column_6'=>$this->integer(4),
            'column_7'=>$this->integer(4),
            'column_8'=>$this->integer(4),
            'column_9'=>$this->integer(4),
            'column_10'=>$this->integer(4),
            'column_11'=>$this->integer(4),
            'column_12'=>$this->integer(4),
            'column_13'=>$this->integer(4),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%anticor_meta}}');
    }
}
