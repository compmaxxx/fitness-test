<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_134425_rename_column_info_user extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_InfoUser_1','info_user');
        $this->renameColumn('info_user','user_id','tester_id');
        $this->addForeignKey('fk_InfoUser_1','info_user','tester_id','tester','id');
    }

    public function down()
    {
        echo "m150114_134425_rename_column_info_user cannot be reverted.\n";

        return false;
    }
}
