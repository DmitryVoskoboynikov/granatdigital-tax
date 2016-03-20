<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_104712_user_status extends Migration
{
    public function up()
    {
        $this->addColumn('{{%user}}', 'status_id', 'TINYINT NOT NULL');
    }

    public function down()
    {
        $this->dropColumn('{{%user}}', 'status_id');
    }
}
