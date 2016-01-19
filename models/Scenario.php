<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "scenario".
 *
 * @property integer $id
 * @property integer $id_station
 * @property string $name
 * @property string $description
 * @property string $short_description
 * @property integer $type
 */
class Scenario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'scenario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_station', 'type'], 'integer'],
            [['description', 'short_description'], 'string'],
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
            'id_station' => 'Id Station',
            'name' => 'Name',
            'description' => 'Description',
            'short_description' => 'Short Description',
            'type' => 'Type',
        ];
    }
}
