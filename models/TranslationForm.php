<?php

namespace app\models;

use yii\base\Model;

class TranslationForm extends Model{
    public $lower,$upper;
    public $value;
    public $lower_val,$upper_val;

    public function rules()
    {
        return [
            [['lower', 'lower_val', 'translate'], 'required','message'=>''],
            [['value'], 'string', 'max' => 200],
            [['lower','upper'], 'string', 'max' => '3'],
            [['lower_val', 'upper_val'], 'double'],
        ];
    }

}
?>