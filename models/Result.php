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
 *
 * @property Test $test
 * @property Tester $tester
 */
class Result extends \yii\db\ActiveRecord
{
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
            [['value'], 'required'],
            [['value'], 'number'],
            [['test_id', 'tester_id'], 'integer']
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
            'tester_id' => 'Tester',
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
}
