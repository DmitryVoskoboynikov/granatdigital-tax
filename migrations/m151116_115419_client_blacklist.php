<?php

use yii\db\Schema;
use yii\db\Migration;

class m151116_115419_client_blacklist extends Migration
{
    public function up()
    {
        $this->addColumn('{{%client}}', 'in_blacklist', 'TINYINT NOT NULL');
        $this->addColumn('{{%client_message}}', 'id', 'INT(11) NOT NULL AUTO_INCREMENT');
        $this->renameColumn('{{%client_message}}', 'type', 'type_id');
        $this->alterColumn('{{%client_message}}', 'created_at', 'DATETIME NULL DEFAULT NULL');

        $this->dropForeignKey('fk_client_message_3', '{{%client_message}}');
        $this->dropColumn('{%client_message}}', 'company_id');

        $this->dropForeignKey('fk_client_message_1', '{{%client_message}}');
        $this->dropPrimaryKey('PRIMARY', '{{%client_message}}');
        $this->addPrimaryKey('pr_key_client_message', '{{%client_message}}', 'id');
        $this->addForeignKey('fk_client_message_1', '{{%client_message}}', 'client_id', '{{%client}}', 'id');
    }

    public function down()
    {
        $this->dropColumn('{{%client}}', 'in_blacklist');
        $this->dropColumn('{{%client_message}}', 'id');
        $this->renameColumn('{{%client_message}}', 'type_id', 'type');
        $this->alterColumn('{{%client_message}}', 'created_at', 'VARCHAR(45) NULL DEFAULT NULL');
    }
}
