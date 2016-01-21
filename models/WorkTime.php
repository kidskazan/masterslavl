<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_time".
 *
 * @property integer $id
 * @property string $name
 * @property integer $week
 * @property string $time_text
 */
class WorkTime extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'work_time';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'week', 'time_text'], 'required'],
            [['week'], 'integer'],
            [['name', 'time_text'], 'string', 'max' => 255]
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
            'week' => 'Week',
            'time_text' => 'Time Text',
        ];
    }
}
