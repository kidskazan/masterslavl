<?php

namespace app\models;

use Yii;
use app\models\SessStation;

class Stations extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'stations';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'price', 'price_increment', 'count_kids', 'id_city'], 'integer'],
            [['short_description', 'full_description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32]
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
            'price' => 'Price',
            'price_increment' => 'Price Increment',
            'count_kids' => 'Count Kids',
            'id_city' => 'Id City',
            'short_description' => 'Short Description',
            'full_description' => 'Full Description',
            'hash' => 'Hash',
        ];
    }

    public function getCountKidsNow()
    {
        if ($this->sessStation)
            return $this->sessStation->count_kids;
    }

    public function getSessStation()
    {
        return $this->hasOne(SessStation::className(), ['id_station' => 'id'])->where(['exit' => 0]);
    }


}
