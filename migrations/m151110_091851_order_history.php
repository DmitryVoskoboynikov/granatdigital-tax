<?php

use yii\db\Schema;
use yii\db\Migration;

class m151110_091851_order_history extends Migration
{
    public function up()
    {
        $this->addColumn('{{%order_history}}', 'id', $this->integer(11));
        $this->dropForeignKey('fk_order_history_1', '{{%order_history}}');
        $this->dropPrimaryKey('PRIMARY', '{{%order_history}}');
        $this->addPrimaryKey('pr_key_order_history', '{{%order_history}}', 'id');
        $this->addForeignKey('fk_order_history_1', '{{%order_history}}', 'order_id', '{{%order}}', 'id');

    }

    public function down()
    {
        $this->dropColumn('{{%order_history}}', 'id');
        $this->dropPrimaryKey('id', '{{%order_history}}');
    }
}
