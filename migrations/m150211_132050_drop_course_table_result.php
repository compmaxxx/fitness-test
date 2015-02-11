<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_132050_drop_course_table_result extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_Result_1','result');
        $this->dropColumn('result','course_id');
    }

    public function down()
    {
        echo "m150211_132050_drop_course_table_result cannot be reverted.\n";

        return false;
    }
}
