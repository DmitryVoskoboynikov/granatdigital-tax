<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_095157_order_option_fix extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_order_options_1', '{{%order_option}}');
        $this->dropPrimaryKey('PRIMARY', '{{%order_option}}');
        $this->addForeignKey('fk_order_options_1', '{{%order_option}}', 'order_id', '{{%order}}', 'id');
    }


    public function down()
    {
        $this->dropForeignKey('fk_order_options_1', '{{%order_option}}');
        $this->addPrimaryKey('PRIMARY', '{{%order_option}}', 'order_id');
        $this->addForeignKey('fk_order_options_1', '{{%order_option}}', 'order_id', '{{%order}}', 'id');
    }
}

