<?php

use yii\db\Schema;
use yii\db\Migration;

class m150113_175735_set_not_null extends Migration
{
    public function up()
    {
        $this->alterColumn('course','name','varchar(150) not null');
        $this->alterColumn('course','create_date',Schema::TYPE_DATETIME.' not null');

    }

    public function down()
    {
        echo "m150113_175735_set_not_null cannot be reverted.\n";

        return false;
    }
}
