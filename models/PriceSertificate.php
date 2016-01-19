<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "price_sertificate".
 *
 * @property integer $id
 * @property string $name
 * @property string $rus_name
 * @property integer $price
 */
class PriceSertificate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'price_sertificate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'rus_name', 'price'], 'required'],
            [['price'], 'integer'],
            [['name', 'rus_name'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'rus_name' => 'Rus Name',
            'price' => 'Price',
        ];
    }
}
