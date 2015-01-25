<?php

use yii\db\Schema;
use yii\db\Migration;

class m150125_202848_add_AI_tb_translation extends Migration
{
    public function up()
    {
        $this->alterColumn('translation','id',Schema::TYPE_INTEGER. ' not null auto_increment');
    }

    public function down()
    {
        echo "m150125_202848_add_AI_tb_translation cannot be reverted.\n";

        return false;
    }
}
