<?php

use yii\db\Schema;
use yii\db\Migration;

class m150327_190147_add_column_gender_translation extends Migration
{
    public function up()
    {
        $this->addColumn('translation','gender',Schema::TYPE_STRING.'(10) not null');
    }

    public function down()
    {
        echo "m150327_190147_add_column_gender_translation cannot be reverted.\n";

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
