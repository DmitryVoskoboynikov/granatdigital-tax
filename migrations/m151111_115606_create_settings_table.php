<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Migration for creating migration table
 *
 * @author Voskoboynikov Dmitry <voskoboynikov@granat-digital.ru>
 */
class m151111_115606_create_settings_table extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%settings}}', [
            'id' => $this->primaryKey(),
            'params' => $this->binary(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);

        $this->batchInsert('{{%settings}}', ['id', 'created_at'], [[1, time()]]);
    }

    public function down()
    {
        $this->dropTable('{{%settings}}');

        return true;
    }
}
