<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "general_options".
 *
 * @property integer $id
 * @property string $name
 * @property string $rus_name
 * @property integer $default_value
 * @property integer $value
 * @property integer $date1
 * @property integer $date2
 */
class GeneralOptions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'general_options';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'rus_name', 'default_value', 'value', 'date1', 'date2'], 'required'],
            [['default_value', 'value', 'date1', 'date2'], 'integer'],
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
            'default_value' => 'Default Value',
            'value' => 'Value',
            'date1' => 'Date1',
            'date2' => 'Date2',
        ];
    }

    public function getDate1Text()
    {
        return date('d.m.Y', $this->date1);
    }

    public function setDate1Text($value)
    {
        $this->date1 = strtotime($value);
    }

    public function getDate2Text()
    {
        return date('d.m.Y', $this->date2);
    }

    public function setDate2Text($value)
    {
        $this->date2 = strtotime($value);
    }

    
}
