<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "result_incomplete".
 *
 * @property integer $course_id
 * @property integer $test_id
 * @property integer $tester_id
 * @property integer $tag
 * @property integer $test_name
 */
class ResultLack extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'result_incomplete';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id'], 'required'],
            [['course_id', 'test_id', 'tester_id', 'tag'], 'integer'],
            [['test_name'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course',
            'test_id' => 'Test ID',
            'tester_id' => 'Tester ID',
            'tag'   => 'Tag',
            'tester_name' => 'Test Name'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
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


}
