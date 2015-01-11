<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tester".
 *
 * @property integer $id
 * @property string $uniq_id
 * @property integer $nisitKU
 *
 * @property InfoUser[] $infoUsers
 * @property Result[] $results
 */
class Tester extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tester';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nisitKU'], 'integer'],
            [['uniq_id'], 'string', 'max' => 20]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uniq_id' => 'Uniq ID',
            'nisitKU' => 'Nisit Ku',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoUsers()
    {
        return $this->hasMany(InfoUser::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['user_id' => 'id']);
    }
}
