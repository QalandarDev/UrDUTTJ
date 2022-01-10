<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ttj.ariza".
 *
 * @property int $id
 * @property int|null $_student
 * @property string|null $about
 * @property string|null $answer
 * @property int|null $status
 * @property int|null $_pdf
 * @property int|null $created_at
 * @property int|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 */
class TtjAriza extends \yii\db\ActiveRecord
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
        return 'ttj.ariza';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['_student', 'status', '_pdf', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'default', 'value' => null],
            [['_student', 'status', '_pdf', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['about', 'answer'], 'string', 'max' => 255],
            [['_pdf'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            '_student' => Yii::t('app', 'Student'),
            'about' => Yii::t('app', 'About'),
            'answer' => Yii::t('app', 'Answer'),
            'status' => Yii::t('app', 'Status'),
            '_pdf' => Yii::t('app', 'Pdf'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
        ];
    }
}
