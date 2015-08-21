<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property integer $id
 * @property integer $id_city
 * @property integer $date
 * @property integer $count_kids
 * @property integer $count_adult
 * @property integer $count_hours
 * @property integer $type_ticket
 * @property string $klass
 * @property integer $summ
 */
class Order extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_city', 'date', 'type_ticket'], 'required'],
            [['id_city', 'date', 'count_kids', 'count_adult', 'count_hours', 'type_ticket', 'summ'], 'integer'],
            [['klass'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'date' => 'Date',
            'count_kids' => 'Count Kids',
            'count_adult' => 'Count Adult',
            'count_hours' => 'Count Hours',
            'type_ticket' => 'Type Ticket',
            'klass' => 'Klass',
            'summ' => 'Summ',
        ];
    }
}
