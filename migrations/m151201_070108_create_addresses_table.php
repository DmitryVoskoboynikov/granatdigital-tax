<?php

use yii\db\Migration;

class m151201_070108_create_addresses_table extends Migration
{
    public function up()
    {
        $this->createTable('{{%address}}', [
            'id' => $this->primaryKey(),
            'address' => $this->string(500),
            'latitude' => $this->decimal(17,14)->notNull(),
            'longitude' => $this->decimal(17,14)->notNull(),
        ]);

        $this->createTable('{{%order_to_address}}', [
            'order_id' => $this->integer()->notNull(),
            'address_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey('fk_order_to_address_1', '{{%order_to_address}}', 'order_id', '{{%order}}', 'id');
        $this->addForeignKey('fk_order_to_address_2', '{{%order_to_address}}', 'address_id', '{{%address}}', 'id');
    }

    public function down()
    {
        $this->dropTable('{{%address}}');
        $this->dropTable('{{%order_to_address}}');
    }
}
