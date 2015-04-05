<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result".
 *
 * @property integer $id
 * @property double $value
 * @property integer $test_id
 * @property integer $tester_id
 * @property string $updated_time
 *
 * @property Test $test
 * @property Tester $tester
 */
class Result extends \yii\db\ActiveRecord
{
    public $course_id;
    public $unit;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value', 'test_id', 'tester_id'], 'required'],
            [['value'], 'number'],
            [['test_id', 'tester_id', 'course_id'], 'integer'],
            [['unit'], 'string', 'max' => 50],
            [['tester_id', 'test_id'], 'unique', 'targetAttribute' => ['tester_id','test_id'] , 'message'=>'It\'s already'],
            [['updated_time'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'value' => 'Value',
            'test_id' => 'Test',
            'tester_id' => 'Tag',
            'course_id' => 'Course',
            'updated_time' => 'Updated Time'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest()
    {
        return $this->hasOne(Test::className(), ['id' => 'test_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTester()
    {
        return $this->hasOne(Tester::className(), ['id' => 'tester_id']);
    }

    public function beforeSave($insert){
        if(!isset($this->updated_time))
            $this->updated_time = new \yii\db\Expression('NOW()');
        return parent::beforeSave($insert);
    }
}
