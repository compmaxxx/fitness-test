<?php

use yii\db\Schema;
use yii\db\Migration;

class m150113_181714_set_not_null_all extends Migration
{
    public function up()
    {
        $this->alterColumn('estimate','name','varchar(150) not null');
        $this->alterColumn('estimate','cal','varchar(300) not null');
        $this->alterColumn('group_course','name','varchar(150) not null');
        $this->alterColumn('info_user','firstname','varchar(100) not null');
        $this->alterColumn('info_user','sex', "enum('ชาย','หญิง') not null");
        $this->alterColumn('test','name', 'varchar(200) not null');
        $this->alterColumn('test','isTime', Schema::TYPE_BOOLEAN.' not null default false');
        $this->alterColumn('tester','uniq_id', 'varchar(20) not null');
        $this->alterColumn('tester','nisitKU', Schema::TYPE_BOOLEAN.' not null' );
        $this->alterColumn('translation','estimate_id', Schema::TYPE_INTEGER.' not null' );
        $this->alterColumn('translation','condition_eval', 'varchar(50) not null' );
        $this->alterColumn('translation','value', 'varchar(200) not null' );

    }

    public function down()
    {
        echo "m150113_181714_set_not_null_all cannot be reverted.\n";

        return false;
    }
}
