<?php

namespace app\models;

use yii\base\Model;

class TranslationForm extends Model{
    public $lower,$upper;
    public $value;
    public $lower_val,$upper_val;
    public $gender;

    private $comparison = [
        '<','<=','>','>=','==','!='
    ];

    public function rules()
    {
        return [
            [['lower', 'lower_val', 'value'], 'required','message'=>''],
            [['value'], 'string', 'max' => 200],
            [['lower','upper'], 'in', 'range' => $this->comparison],
            [['lower_val', 'upper_val'], 'double'],
            [['gender'], 'in', 'range' => ['ทั้งหมด','ชาย','หญิง']]
        ];
    }

}
?>