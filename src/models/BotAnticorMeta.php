<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bot.anticor_meta".
 *
 * @property int|null $UserID
 * @property int|null $column_1
 * @property int|null $column_2
 * @property int|null $column_3
 * @property int|null $column_4
 * @property int|null $column_5
 * @property int|null $column_6
 * @property int|null $column_7
 * @property int|null $column_8
 * @property int|null $column_9
 * @property int|null $column_10
 * @property int|null $column_11
 * @property int|null $column_12
 * @property int|null $column_13
 */
class BotAnticorMeta extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot.anticor_meta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['UserID', 'column_1', 'column_2', 'column_3', 'column_4', 'column_5', 'column_6', 'column_7', 'column_8', 'column_9', 'column_10', 'column_11', 'column_12', 'column_13'], 'default', 'value' => null],
            [['UserID', 'column_1', 'column_2', 'column_3', 'column_4', 'column_5', 'column_6', 'column_7', 'column_8', 'column_9', 'column_10', 'column_11', 'column_12', 'column_13'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'column_1' => 'Column 1',
            'column_2' => 'Column 2',
            'column_3' => 'Column 3',
            'column_4' => 'Column 4',
            'column_5' => 'Column 5',
            'column_6' => 'Column 6',
            'column_7' => 'Column 7',
            'column_8' => 'Column 8',
            'column_9' => 'Column 9',
            'column_10' => 'Column 10',
            'column_11' => 'Column 11',
            'column_12' => 'Column 12',
            'column_13' => 'Column 13',
        ];
    }
}
