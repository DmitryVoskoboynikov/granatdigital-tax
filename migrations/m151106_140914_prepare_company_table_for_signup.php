<?php

use yii\db\Schema;
use yii\db\Migration;

class m151106_140914_prepare_company_table_for_signup extends Migration
{
    public function up()
    {
        $this->addColumn('{{%company}}', 'title', $this->text());
        $this->addColumn('{{%company}}', 'dispatcher_phone', $this->bigInteger());
        $this->addColumn('{{%company}}', 'legal_address', $this->string());
        $this->addColumn('{{%company}}', 'physical_address', $this->string());
        $this->addColumn('{{%company}}', 'inn', $this->bigInteger());
        $this->addColumn('{{%company}}', 'kpp', $this->bigInteger());
        $this->addColumn('{{%company}}', 'bank', $this->string());
        $this->addColumn('{{%company}}', 'bik', $this->bigInteger());
        $this->addColumn('{{%company}}', 'okpo', $this->bigInteger());
        $this->addColumn('{{%company}}', 'ogrn', $this->bigInteger());

        $this->dropForeignKey('fk_company_1', '{{%company}}');
    }

    public function down()
    {
        $this->addForeignKey('fk_company_1', '{{%company}}', 'id', '{{%user}}', 'id', 'CASCADE', 'CASCADE');

        $this->dropColumn('{{%company}}', 'title');
        $this->dropColumn('{{%company}}', 'dispatcher_phone');
        $this->dropColumn('{{%company}}', 'legal_address');
        $this->dropColumn('{{%company}}', 'physical_address');
        $this->dropColumn('{{%company}}', 'inn');
        $this->dropColumn('{{%company}}', 'kpp');
        $this->dropColumn('{{%company}}', 'bank');
        $this->dropColumn('{{%company}}', 'bik');
        $this->dropColumn('{{%company}}', 'okpo');
        $this->dropColumn('{{%company}}', 'ogrn');

        return true;
    }
}
