<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "rel_order_people".
 *
 * @property integer $id
 * @property integer $id_order
 * @property integer $id_people
 * @property integer $type_people
 */
class RelOrderPeople extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rel_order_people';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_order', 'id_people', 'type_people'], 'required'],
            [['id_order', 'id_people', 'type_people'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id Order',
            'id_people' => 'Id People',
            'type_people' => 'Type People',
        ];
    }
}
