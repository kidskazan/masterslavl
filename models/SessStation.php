<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sess_station".
 *
 * @property integer $id
 * @property integer $id_station
 * @property integer $id_mentor
 * @property integer $input
 * @property integer $exit
 * @property integer $count_kids
 * @property string $token
 */
class SessStation extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sess_station';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_station', 'id_mentor', 'input', 'exit', 'count_kids'], 'integer'],
            [['token'], 'string', 'max' => 32]
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
            'id_mentor' => 'Id Mentor',
            'input' => 'Input',
            'exit' => 'Exit',
            'count_kids' => 'Count Kids',
            'token' => 'Token',
        ];
    }
}
