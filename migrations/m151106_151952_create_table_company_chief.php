<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_151952_create_table_company_chief extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%company_chief}}', [
            'id' => $this->primaryKey(),
            'company_id' => $this->integer()->notNull(),
            'first_name' => $this->string()->notNull(),
            'second_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'post' => $this->string()->notNull(),
            'phone' => $this->bigInteger(),
            'email' => $this->string(),
        ], $tableOptions);

        $this->addForeignKey('company_company_chief_fk', '{{%company_chief}}', 'company_id', '{{%company}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('company_company_chief_fk', '{{%company_chief}}');
        $this->dropTable('{{%company_chief}}');

        return true;
    }
}
