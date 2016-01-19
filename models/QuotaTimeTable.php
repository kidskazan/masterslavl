<?php

namespace app\models;

use Yii;
use app\models\QuotaType;
use yii\helpers\ArrayHelper; 

/**
 * This is the model class for table "quota_time_table".
 *
 * @property integer $id
 * @property integer $start_date
 * @property integer $end_date
 * @property integer $id_type
 */
class QuotaTimeTable extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'quota_time_table';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['start_date', 'end_date', 'id_type'], 'required'],
            [['start_date', 'end_date', 'id_type'], 'integer'],
            [['startDateText', 'endDateText'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'start_date' => 'Дата начала',
            'end_date' => 'Дата конца',
            'id_type' => 'Тип квоты',
            'type' => 'Тип квоты',
            'startDateText' => 'Дата начала',
            'endDateText' => 'Дата конца'
        ];
    }

    public function getStartDateText()
    {
        return date('d.m.Y', $this->start_date);
    }

    public function getEndDateText()
    {
        return date('d.m.Y', $this->end_date);
    }

    public function setStartDateText($value)
    {
        $this->start_date = strtotime($value);
    }

    public function setEndDateText($value)
    {
        $this->end_date = strtotime($value);
    }


    public function getQuotaType()
    {
        return $this->hasOne(QuotaType::className(), ['id' => 'id_type']);
    }

    public function getQuotaTypeAllForSelect()
    {
        $QuotaType = QuotaType::find()->All();

        return ArrayHelper::map($QuotaType, 'id', 'name');
    }

    public function getType()
    {
        return $this->quotaType->name;
    }


}
