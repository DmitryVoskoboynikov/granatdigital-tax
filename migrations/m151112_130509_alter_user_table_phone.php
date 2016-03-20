<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_130509_alter_user_table_phone extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%user}}', 'phone', 'bigint(20) DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('{{%user}}', 'phone', 'int(11) NOT NULL');

        return true;
    }
}
