<?php

use yii\db\Schema;
use yii\db\Migration;

class m150117_085712_add_estimate_id_table_test extends Migration
{
    public function up()
    {
        $this->addColumn('test','estimate_id',Schema::TYPE_INTEGER.' not null');
        $this->addForeignKey('fk_Test_1','test','estimate_id','estimate','id','cascade','cascade');
    }

    public function down()
    {
        echo "m150117_085712_add_estimate_id_table_test cannot be reverted.\n";

        return false;
    }
}
