<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $name
 * @property string $text
 * @property integer $date
 * @property integer $image
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'text', 'date', 'image'], 'required'],
            [['id', 'date', 'image'], 'integer'],
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
            'name' => 'Name',
            'text' => 'Text',
            'date' => 'Date',
            'image' => 'Image',
        ];
    }
}
