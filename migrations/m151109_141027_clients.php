<?php

use yii\db\Schema;
use yii\db\Migration;

class m151109_141027_clients extends Migration
{
    public function up()
    {
        $this->createIndex('fk_client_uniquie_phone', '{{client}}', 'phone', true);
    }

    public function down()
    {
        $this->dropIndex('fk_client_uniquie_phone', '{{client}}');
    }
}
