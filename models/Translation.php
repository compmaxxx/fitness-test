<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "translation".
 *
 * @property integer $id
 * @property integer $estimate_id
 * @property string $condition_eval
 * @property string $value
 *
 * @property Estimate $estimate
 */
class Translation extends \yii\db\ActiveRecord
{
    public $comparison1,$comparison2;
    public $val1,$val2;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translation';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'estimate_id', 'condition_eval', 'value', 'comparison1', 'val1'], 'required'],
            [['id', 'estimate_id', 'val1', 'val2'], 'integer'],
            [['condition_eval'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 200],
            [['comparision1','comparision2'], 'string', 'max' => '3'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estimate_id' => 'Estimate ID',
            'condition_eval' => 'Condition Eval',
            'value' => 'Value',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstimate()
    {
        return $this->hasOne(Estimate::className(), ['id' => 'estimate_id']);
    }

}
