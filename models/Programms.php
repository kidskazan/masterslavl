<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "programms".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $photo
 * @property integer $start_date
 * @property integer $end_date
 */
class Programms extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */

    public $file;

    public static function tableName()
    {
        return 'programms';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['file'], 'file'],
            [['photo'], 'string', 'max' => 1000]
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
            'description' => 'Description',
            'photo' => 'Photo',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
        ];
    }

    public function getStartDateText()
    {
        return date('d.m.Y', $this->start_date);
    }

    public function getEndDateText()
    {
        return date('d.m.Y', $this->end_date);
    }

    public function setStartDateText($value)
    {
        $this->start_date = strtotime($value);
    }

    public function setEndDateText($value)
    {
        $this->end_date = strtotime($value);
    }

}
