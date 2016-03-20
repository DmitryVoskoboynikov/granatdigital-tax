<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_130431_order_message extends Migration
{
    public function up()
    {
        $this->addColumn('{{%order_message}}', 'created_at', $this->dateTime());
        $this->alterColumn('{{%order_message}}', 'id', 'int(11) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        $this->dropColumn('{{%order_message}}', 'created_at');
        $this->alterColumn('{{%order_message}}', 'id', 'int(11) NOT NULL');
    }
}
