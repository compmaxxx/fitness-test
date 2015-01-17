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
            [['tester_id', 'age'], 'integer'],
            [['firstname', 'lastname', 'sex', 'age'], 'required'],
            [['sex'], 'string'],
            [['firstname', 'lastname'], 'string', 'max' => 100]
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
