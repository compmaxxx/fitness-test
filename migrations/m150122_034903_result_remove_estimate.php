<?php

use yii\db\Schema;
use yii\db\Migration;

class m150122_034903_result_remove_estimate extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_Result_2','result');
        $this->dropColumn('result','estimate_id');
    }

    public function down()
    {
        $this->addColumn('result','estimate_id',Schema::TYPE_INTEGER);
        $this->addForeignKey('fk_Result_2','result','estimate_id','estimate','id');
    }
}
