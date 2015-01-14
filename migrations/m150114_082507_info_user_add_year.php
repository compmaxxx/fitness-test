<?php

use yii\db\Schema;
use yii\db\Migration;

class m150114_082507_info_user_add_year extends Migration
{
    public function up()
    {
        $this->dropColumn('info_user','birthDate');
        $this->addColumn('info_user','year',Schema::TYPE_INTEGER.' not null');

    }

    public function down()
    {
        echo "m150114_082507_info_user_add_year cannot be reverted.\n";

        return false;
    }
}
