<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_152859_prepare_user_table_for_signup extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%user}}', 'salt', 'char(10) DEFAULT NULL');
    }

    public function down()
    {
       $this->alterColumn('{{%user}}', 'salt', 'char(10) NOT NULL');

       return true;
    }
}
