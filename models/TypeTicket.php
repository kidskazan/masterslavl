<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "type_ticket".
 *
 * @property integer $id
 * @property string $name
 * @property integer $age_min
 * @property integer $age_max
 */
class TypeTicket extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'type_ticket';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'age_min', 'age_max'], 'required'],
            [['age_min', 'age_max'], 'integer'],
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
            'name' => 'Название',
            'age_min' => 'Возраст MIN',
            'age_max' => 'Возраст MAX',
        ];
    }
}
