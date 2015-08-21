<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "city".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property integer $capacity
 * @property integer $count_kids
 * @property integer $status
 * @property integer $maxKids
 */
class City extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'city';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description', 'short_description', 'capacity', 'count_kids', 'status', 'maxKids'], 'required'],
            [['description', 'short_description'], 'string'],
            [['capacity', 'count_kids', 'status', 'maxKids'], 'integer'],
            [['name'], 'string', 'max' => 255]
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
            'description' => 'Description',
            'short_description' => 'Short Description',
            'capacity' => 'Capacity',
            'count_kids' => 'Count Kids',
            'status' => 'Status',
            'maxKids' => 'Max Kids',
        ];
    }
}
