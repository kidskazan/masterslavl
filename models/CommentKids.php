<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comment_kids".
 *
 * @property integer $id
 * @property integer $id_kids
 * @property integer $id_mentor
 * @property integer $id_station
 * @property integer $date
 * @property integer $text
 */
class CommentKids extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'comment_kids';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_kids', 'id_mentor', 'id_station', 'date'], 'integer'],
            [['text'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_kids' => 'Id Kid',
            'id_mentor' => 'Id Mentor',
            'id_station' => 'Id Station',
            'date' => 'Date',
            'text' => 'Text',
        ];
    }
}
