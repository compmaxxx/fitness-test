<?php

use yii\db\Schema;
use yii\db\Migration;

class m150210_202531_add_tag_for_tester extends Migration
{
    public function up()
    {
        /*Table Tester*/
        $this->addColumn('tester','course_id',Schema::TYPE_INTEGER.' not null');
        $this->addForeignKey('fk_Tester_1','tester','course_id','course','id','cascade','cascade');

        $this->addColumn('tester','tag',Schema::TYPE_INTEGER.' not null');

        $this->dropColumn('tester','uniq_id');
        $this->dropColumn('tester','nisitKU');
        /*Table Tester*/

        /*Table InfoUser*/
        $this->addColumn('info_user','uniq_id', Schema::TYPE_STRING);
        $this->addColumn('info_user','nisit_ku', Schema::TYPE_BOOLEAN.' default true');
        /*Table InfoUser*/
    }

    public function down()
    {
        echo "m150210_202531_add_tag_for_tester cannot be reverted.\n";

        return false;
    }
}
