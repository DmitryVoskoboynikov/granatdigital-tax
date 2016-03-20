<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_131327_order_fix extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%order}}', 'client_name');
        $this->addColumn('{{%order}}', 'car_id', 'INT(11) NULL');
        $this->addForeignKey('fk_orders_3', '{{%order}}', 'car_id', '{{%car}}', 'id');
        $this->alterColumn('{{%order_history}}', 'id', 'INT(11) NOT NULL AUTO_INCREMENT');
    }

    public function down()
    {
        $this->dropForeignKey('fk_orders_3', '{{%order}}');
        $this->dropColumn('car_id', '{{%order}}');
        $this->addColumn('{{%order}}', 'client_name', 'VARCHAR(45)');
        $this->alterColumn('{{%order_history}}', 'id', 'INT(11) NOT NULL');
    }
}
