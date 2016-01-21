<?php

namespace app\models;

use Yii;
use app\models\Parents;

/**
 * This is the model class for table "news_uvedomlenie".
 *
 * @property integer $id
 * @property integer $id_parents
 * @property string $text
 * @property string $name
 * @property integer $date
 * @property integer $status
 */
class NewsUvedomlenie extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news_uvedomlenie';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_parents', 'text', 'name'], 'required'],
            [['id_parents', 'date', 'status'], 'integer'],
            [['text'], 'string'],
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
            'id_parents' => 'Id Parents',
            'text' => 'Text',
            'name' => 'Name',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    public function getParent()
    {
        return $this->hasOne(Parents::className(), ['id' => 'id_parents']);
    }
}
