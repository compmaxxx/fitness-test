<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_user".
 *
 * @property integer $id
 * @property integer $tester_id
 * @property string $firstname
 * @property string $lastname
 * @property string $sex
 * @property integer $age
 * @property string $uniq_id
 * @property integer $nisit_ku
 *
 * @property Tester $tester
 */
class InfoUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'info_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tester_id', 'age', 'nisit_ku'], 'integer'],
            [['firstname', 'lastname', 'sex', 'age'], 'required'],
            [['sex'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['uniq_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'tester_id' => 'Tester ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'sex' => 'Sex',
            'age' => 'Age',
            'uniq_id' => 'Uniq ID',
            'nisit_ku' => 'Nisit Ku',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTester()
    {
        return $this->hasOne(Tester::className(), ['id' => 'tester_id']);
    }
}
