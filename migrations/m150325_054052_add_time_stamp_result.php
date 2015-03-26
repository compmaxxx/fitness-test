<?php

use yii\db\Schema;
use yii\db\Migration;

class m150325_054052_add_time_stamp_result extends Migration
{
    public function up()
    {
        $this->truncateTable('result');
        $this->addColumn('result','updated_time',Schema::TYPE_DATETIME);
    }

    public function down()
    {
        echo "m150325_054052_add_time_stamp_result cannot be reverted.\n";

        return false;
    }
    
    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }
    
    public function safeDown()
    {
    }
    */
}
