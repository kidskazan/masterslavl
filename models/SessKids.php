<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sess_kids".
 *
 * @property integer $id
 * @property integer $id_kids
 * @property string $id_station
 * @property string $id_mentor
 * @property string $action
 * @property integer $date
 */
class SessKids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess_kids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kids', 'id_station', 'id_mentor', 'action', 'date'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kids' => 'Id Kids',
            'id_station' => 'Id Station',
            'id_mentor' => 'Id Mentor',
            'action' => 'Action',
            'date' => 'Date',
        ];
    }
}