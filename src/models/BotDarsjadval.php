<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bot.darsjadval".
 *
 * @property int $UserID
 * @property string|null $FirstName
 */
class BotDarsjadval extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bot.darsjadval';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
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
        ];
    }
}
