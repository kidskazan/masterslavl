<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_ticket2".
 *
 * @property integer $id
 * @property integer $type_ticket
 * @property integer $type_day
 * @property integer $hours
 * @property integer $price
 */
class PriceTicket3 extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_ticket3';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type_ticket', 'type_day', 'hours', 'price'], 'required'],
            [['type_ticket', 'type_day', 'hours', 'price'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type_ticket' => 'Type Ticket',
            'type_day' => 'Type Day',
            'hours' => 'Hours',
            'price' => 'Price',
        ];
    }
}
