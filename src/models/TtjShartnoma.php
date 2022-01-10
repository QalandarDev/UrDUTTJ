<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ttj.shartnoma".
 *
 * @property int $id
 * @property int|null $number
 * @property int|null $_student
 * @property int|null $_pdf
 * @property int|null $_xona
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class TtjShartnoma extends \yii\db\ActiveRecord
{
    public const STATUS_PENDING=8;//yangi
    public const STATUS_ACTIVE=9;//faol
    public const STATUS_REJECTED=10;//rad etilgan
    public const STATUS_DEACTIVATED=11;//tugatilgan
    public const STATUS_ARCHIVE=12;//arxivlangan
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ttj.shartnoma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number', '_student', '_pdf', '_xona', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['number', '_student', '_pdf', '_xona', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'number' => Yii::t('app', 'Number'),
            '_student' => Yii::t('app', 'Student'),
            '_pdf' => Yii::t('app', 'Pdf'),
            '_xona' => Yii::t('app', 'Xona'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
