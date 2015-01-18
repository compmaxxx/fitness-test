<?php

use yii\db\Schema;
use yii\db\Migration;

class m150118_184445_add_column_course_active extends Migration
{
    public function up()
    {
        $this->addColumn('course','is_active',Schema::TYPE_BOOLEAN.' not null default false');
    }

    public function down()
    {
        echo "m150118_184445_add_column_course_active cannot be reverted.\n";

        return false;
    }
}
