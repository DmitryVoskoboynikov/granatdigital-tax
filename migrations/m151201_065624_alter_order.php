<?php

use yii\db\Migration;

class m151201_065624_alter_order extends Migration
{
    public function up()
    {
        $this->dropColumn('{{%order}}', 'address');
        $this->dropColumn('{{%order}}', 'address_destination');
        $this->addColumn('{{%order}}', 'distance', $this->decimal('10.2'));
    }

    public function down()
    {
        $this->addColumn('{{%order}}', 'address', $this->string(45));
        $this->addColumn('{{%order}}', 'address_destination', $this->string(45));
        $this->dropColumn('{{%order}}', 'distance');
    }
}
