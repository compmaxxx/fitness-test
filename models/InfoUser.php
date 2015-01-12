<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_user".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $firstname
 * @property string $lastname
 * @property string $sex
 * @property string $birthdate
 *
 * @property Tester $user
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
            [['user_id'], 'integer'],
            [['lastname', 'birthdate'], 'required'],
            [['birthdate'], 'safe'],
            [['firstname', 'lastname'], 'string', 'max' => 100],
            [['sex'], 'string', 'max' => 6]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'sex' => 'Sex',
            'birthdate' => 'Birthdate',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Tester::className(), ['id' => 'user_id']);
    }
}
