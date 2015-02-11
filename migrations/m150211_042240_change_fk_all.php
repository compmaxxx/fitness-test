<?php

use yii\db\Schema;
use yii\db\Migration;

class m150211_042240_change_fk_all extends Migration
{
    public function up()
    {
        /*Table Add Course*/
        $this->dropForeignKey('fk_TRC_1','add_course');
        $this->dropForeignKey('fk_TRC_2','add_course');

        $this->addForeignKey('fk_AddCourse_1','add_course','course_id','course','id','cascade','cascade');
        $this->addForeignKey('fk_AddCourse_2','add_course','estimate_id','estimate','id','cascade','cascade');
        /*Table Add Course*/

        /*Table Course*/
        $this->dropForeignKey('fk_Course_1','course');
        $this->addForeignKey('fk_Course_1','course','groupcourse_id','group_course','id','no action','cascade');
        /*Table Course*/

        /*Table InfoUser*/
        $this->dropForeignKey('fk_InfoUser_1','info_user');
        $this->dropColumn('info_user','tester_id');
        /*Table InfoUser*/

        /*Table Result*/
        $this->dropForeignKey('fk_Result_1','result');
        $this->dropForeignKey('fk_Result_3','result');
        $this->dropForeignKey('fk_Result_4','result');

        $this->addForeignKey('fk_Result_1','result','course_id','course','id','set null','cascade');
        $this->addForeignKey('fk_Result_2','result','test_id','test','id','set null','cascade');
        $this->addForeignKey('fk_Result_3','result','tester_id','tester','id','set null','cascade');
        /*Table Result*/

        /*Table Test*/
        $this->dropForeignKey('fk_Test_1','test');
        $this->addForeignKey('fk_Test_1','test','estimate_id','estimate','id','cascade','cascade');
        /*Table Test*/

        /*Table Tester*/
        $this->addColumn('tester','info_user_id',Schema::TYPE_INTEGER.' default null');
        $this->addForeignKey('fk_Tester_2','tester','info_user_id','info_user','id','set null','cascade');
        /*Table Tester*/

        /*Table Translation*/
        $this->dropForeignKey('fk_Translation_1','translation');
        $this->addForeignKey('fk_Translation_1','translation','estimate_id','estimate','id','cascade','cascade');
        /*Table Translation*/


    }

    public function down()
    {
        echo "m150211_042240_change_fk_all cannot be reverted.\n";

        return false;
    }
}
