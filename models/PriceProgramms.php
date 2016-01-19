<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_programms".
 *
 * @property integer $id
 * @property integer $id_programm
 * @property integer $id_time
 * @property integer $price
 */
class PriceProgramms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_programms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_programm', 'id_time', 'price'], 'required'],
            [['id_programm', 'id_time', 'price'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_programm' => 'Id Programm',
            'id_time' => 'Id Time',
            'price' => 'Price',
        ];
    }
}
