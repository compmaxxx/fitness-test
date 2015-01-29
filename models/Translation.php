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
            [['estimate_id', 'condition_eval', 'value'], 'required'],
            [['estimate_id'], 'integer'],
            [['condition_eval'], 'string', 'max' => 50],
            [['value'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estimate_id' => 'Estimate',
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
