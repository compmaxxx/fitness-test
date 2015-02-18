<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tester".
 *
 * @property integer $id
 * @property integer $course_id
 * @property integer $tag
 * @property integer $info_user_id
 *
 * @property Result[] $results
 * @property InfoUser $infoUser
 * @property Course $course
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
            [['course_id', 'tag'], 'required'],
            [['course_id', 'tag', 'info_user_id'], 'integer'],
            [['course_id', 'tag'], 'unique', 'targetAttribute' => ['course_id', 'tag']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_id' => 'Course',
            'tag' => 'Tag',
            'info_user_id' => 'Uniq ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['tester_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfoUser()
    {
        return $this->hasOne(InfoUser::className(), ['id' => 'info_user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::className(), ['id' => 'course_id']);
    }
}
