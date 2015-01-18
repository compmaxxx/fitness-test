<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "course".
 *
 * @property integer $id
 * @property string $name
 * @property string $location
 * @property string $create_date
 * @property integer $groupcourse_id
 * @property integer $is_active
 *
 * @property AddCourse[] $addCourses
 * @property Estimate[] $estimates
 * @property GroupCourse $groupcourse
 * @property Result[] $results
 */
class Course extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'create_date','groupcourse_id'], 'required'],
            [['create_date', 'groupcourse_id', 'is_active'], 'safe'],
            [['groupcourse_id', 'is_active'], 'integer'],
            [['name', 'location'], 'string', 'max' => 150]
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
            'location' => 'Location',
            'create_date' => 'Create Date',
            'groupcourse_id' => 'Groupcourse ID',
            'is_active' => 'Is Active',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddCourses()
    {
        return $this->hasMany(AddCourse::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstimates()
    {
        return $this->hasMany(Estimate::className(), ['id' => 'estimate_id'])->viaTable('add_course', ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupcourse()
    {
        return $this->hasOne(GroupCourse::className(), ['id' => 'groupcourse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['course_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::className(), ['estimate_id' => 'id'])->viaTable('estimate',['id' => 'estimate_id'])->viaTable('add_course',['course_id' => 'id']);
    }
}
