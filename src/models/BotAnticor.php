<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bot.anticor".
 *
 * @property int $UserID
 * @property string|null $FirstName
 * @property int|null $Step
 */
class BotAnticor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot.anticor';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['Step'], 'default', 'value' => null],
            [['Step'], 'integer'],
            [['FirstName'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'UserID' => 'User ID',
            'FirstName' => 'First Name',
            'Step' => 'Step',
        ];
    }
}
