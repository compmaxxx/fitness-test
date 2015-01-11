<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "group_estimate".
 *
 * @property integer $id
 * @property string $name
 *
 * @property Estimate[] $estimates
 */
class GroupEstimate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'group_estimate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 150]
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstimates()
    {
        return $this->hasMany(Estimate::className(), ['groupEst_id' => 'id']);
    }
}
