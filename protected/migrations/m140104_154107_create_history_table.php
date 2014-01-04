<?php

class m140104_154107_create_history_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_history', array(
            'id' => 'pk',
            'name' => 'varchar(255) NOT NULL',
            'tst' => 'timestamp',
            'create_time' => 'int NOT NULL',
            'update_time' => 'int NOT NULL',
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_history');
    }
}