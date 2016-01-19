<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customs".
 *
 * @property integer $id
 * @property string $name
 * @property string $surname
 * @property string $father_name
 * @property integer $birthday
 * @property string $qr
 * @property integer $date
 * @property integer $likes
 * @property integer $dislikes
 * @property string $description
 * @property string $login
 * @property string $password
 * @property string $token
 * @property string $reg_id
 * @property integer $id_city
 */
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
}