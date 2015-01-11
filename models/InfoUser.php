<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_user".
 *
 * @property integer $id
 * @property string $name
 * @property string $sex
 * @property integer $user_id
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
            [['name'], 'string', 'max' => 200],
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
            'name' => 'Name',
            'sex' => 'Sex',
            'user_id' => 'User ID',
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
