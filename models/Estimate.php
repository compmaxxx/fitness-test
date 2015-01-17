<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estimate".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $cal
 *
 * @property AddCourse[] $addCourses
 * @property Course[] $courses
 * @property Result[] $results
 * @property Test[] $tests
 * @property Translation[] $translations
 */
class Estimate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'estimate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'cal'], 'required'],
            [['name', 'description'], 'string', 'max' => 150],
            [['cal'], 'string', 'max' => 300]
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
            'description' => 'Description',
            'cal' => 'Cal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddCourses()
    {
        return $this->hasMany(AddCourse::className(), ['estimate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCourses()
    {
        return $this->hasMany(Course::className(), ['id' => 'course_id'])->viaTable('add_course', ['estimate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getResults()
    {
        return $this->hasMany(Result::className(), ['estimate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTests()
    {
        return $this->hasMany(Test::className(), ['estimate_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTranslations()
    {
        return $this->hasMany(Translation::className(), ['estimate_id' => 'id']);
    }
}
