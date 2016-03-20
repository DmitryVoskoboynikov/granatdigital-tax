<?php

use yii\db\Schema;
use yii\db\Migration;

class m151115_103457_car_fix extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%car}}', 'id', 'INT(11) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        $this->alterColumn('{{%car}}', 'id', 'INT(11) NOT NULL');
    }
}
