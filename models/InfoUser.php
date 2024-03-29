<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_user".
 *
 * @property integer $id
 * @property string $firstname
 * @property string $lastname
 * @property string $sex
 * @property integer $age
 * @property string $uniq_id
 * @property integer $nisit_ku
 *
 * @property Tester[] $testers
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
            [['firstname', 'lastname', 'sex', 'age'], 'required'],
            [['sex'], 'string'],
            [['age', 'nisit_ku'], 'integer'],
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
    public function getTesters()
    {
        return $this->hasMany(Tester::className(), ['info_user_id' => 'id']);
    }
}
