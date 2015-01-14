<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_135659_set_null_constraint extends Migration
{
    public function up()
    {
        $this->alterColumn('result','value',Schema::TYPE_FLOAT.' not null');
        $this->renameColumn('info_user','year','age');
        $this->dropForeignKey('fk_Result_4','result');
        $this->renameColumn('result','user_id','tester_id');
        $this->addForeignKey('fk_Result_4','result','tester_id','tester','id','cascade','cascade');
    }

    public function down()
    {
        echo "m150114_135659_set_null_constraint cannot be reverted.\n";

        return false;
    }
}
