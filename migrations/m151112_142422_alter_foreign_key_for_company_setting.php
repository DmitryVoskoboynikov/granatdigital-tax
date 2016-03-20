<?php

use yii\db\Schema;
use yii\db\Migration;

class m151112_142422_alter_foreign_key_for_company_setting extends Migration
{
    public function up()
    {
        $this->dropForeignKey('fk_company_settings_1', '{{%company_setting}}');

        $this->addForeignKey('company_company_settings_fk', '{{%company_setting}}', 'company_id', '{{%company}}', 'id', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->addForeignKey('fk_company_settings_1', '{{%company_setting}}', 'company_id', '{{%company}}', 'id', 'NO ACTION', 'NO ACTION');
        $this->dropForeignKey('company_company_settings_fk', '{{%company_setting}}');

        return true;
    }
}
