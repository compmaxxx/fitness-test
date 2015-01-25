<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "test".
 *
 * @property integer $id
 * @property string $name
 * @property string $unit
 * @property integer $isTime
 * @property integer $estimate_id
 *
 * @property Result[] $results
 * @property Estimate $estimate
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'test';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['isTime', 'estimate_id'], 'integer'],
            [['name'], 'string', 'max' => 200],
            [['unit'], 'string', 'max' => 50],
            [['estimate_id'], 'safe'],
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
            'unit' => 'Unit',
            'isTime' => 'Is Time',
            'estimate_id' => 'Estimate ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['test_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstimate()
    {
        return $this->hasOne(Estimate::className(), ['id' => 'estimate_id']);
    }
}
