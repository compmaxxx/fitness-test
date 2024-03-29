<?php
/**
 * Created by PhpStorm.
 * User: compmaxxx
 * Date: 1/29/15
 * Time: 11:30 AM
 */

namespace app\models;


use yii\base\Model;

class Assessment extends Model {
    /*Initial by tester_id, estimate_id, course_id*/
    public $tester_id,$estimate_id/*,$course_id*/;
    public $result;
    public $translation_result;

    public function rules(){
        return [
            [['tester_id', 'estimate_id', /*'course_id'*/], 'required'],
            ['tester_id', 'exist', 'targetClass' => Tester::className(), 'targetAttribute' => 'id'],
            ['estimate_id', 'exist', 'targetClass' => Estimate::className(), 'targetAttribute' => 'id'],
//            ['course_id', 'exist', 'targetClass' => Course::className()],
            [['tester_id', 'estimate_id'/*, 'course_id'*/, 'result'], 'integer'],
            [['translation_result'], 'string', 'max' => 200],
        ];
    }

    public function translate(){

//        $this->checkInitValue();

        $estimate = Estimate::findOne($this->estimate_id);

        $tests = $estimate->getTests()->all();
        $translations = $estimate->getTranslations()->all();
        $user = Tester::findOne($this->tester_id)->getInfoUser()->one();

        $pattern = [];
        $replacement = [];
        foreach($tests as $test){
            $result= Result::find()->where([
                'tester_id' => $this->tester_id,
                'test_id'   => $test->id,
            ])->one();
            if($result != null){
                $replacement[] = $result->value;
            }else{
                $this->result = null;
                $this->translation_result = null;
                return ;
            }

            $pattern[] = '/'.$test->name.'/';
        }

        $this->result = $this->calculateResult($estimate->cal, $pattern, $replacement);



        foreach ($translations as $translation) {

            if ($translation->gender == $user->sex) {
                $condition = $translation->condition_eval;
                $expression = preg_replace('/result/', $this->result, $condition);
                $condition_eval = null;
                eval('$condition_eval = ' . $expression . ';');
//            var_dump($condition_eval);
                if ($condition_eval !== null) {
                    if($condition_eval == true)
                        $this->translation_result = $translation->value;
                }

            }

        }

    }

    public function checkInitValue()
    {
        if (isset($this->course_id)){
            $course = Course::findOne($this->course_id);

            if ($course == null){
                $this->addError('course_id', 'Don\'t have this Course');
            }
        }
        else{
            $this->addError('course_id', 'Course ID is not assign');
        }
        if (isset($this->tester_id)) {
            $tester = Tester::findOne($this->tester_id);

            if ($tester == null) {
                $this->addError('tester_id', 'Don\'t have this Tester');
            }
        } else {
            $this->addError('tester_id', 'Tester ID is not assign');
        }


        if (isset($this->estimate_id)) {
            $estimate = Estimate::findOne($this->estimate_id);
            if ($estimate == null) {
                $this->addError('estimate_id', 'Don\'t have this Estimate');
            }
        } else {
            $this->addError('estimate_id', 'Estimate ID is not assign');
        }
    }

    /**
     * @param $cal
     * @param $pattern
     * @param $replacement
     */
    public function calculateResult($cal, $pattern, $replacement)
    {
        $result = -1;
        $expression = preg_replace($pattern, $replacement, $cal);

        eval('$result = ' . $expression . ';');
        return $result;
    }

}