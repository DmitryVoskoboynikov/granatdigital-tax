<?php

use yii\db\Schema;
use yii\db\Migration;

class m151123_083346_fix_client extends Migration
{
    public function up()
    {
        $this->alterColumn('{{%client}}', 'phone', $this->bigInteger(11)->notNull()->unique());
    }

    public function down()
    {
        $this->alterColumn('{{%client}}', 'phone', $this->integer(11));
    }
}
