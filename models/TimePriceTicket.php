<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "time_price_ticket".
 *
 * @property integer $id
 * @property integer $date1
 * @property integer $date2
 * @property integer $type
 */
class TimePriceTicket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'time_price_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date1', 'date2', 'type'], 'required'],
            [['date1', 'date2', 'type'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date1' => 'Date1',
            'date2' => 'Date2',
            'type' => 'Type',
        ];
    }

    public function getStartDateText()
    {
        return date('d.m.Y', $this->date1);
    }

    public function getEndDateText()
    {
        return date('d.m.Y', $this->date2);
    }

    public function setStartDateText($value)
    {
        $this->date1 = strtotime($value);
    }

    public function setEndDateText($value)
    {
        $this->date2 = strtotime($value);
    }
}
