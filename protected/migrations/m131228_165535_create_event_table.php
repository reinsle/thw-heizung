<?php

class m131228_165535_create_event_table extends CDbMigration
{
    public function up()
    {
        $this->createTable('tbl_event', array(
            'uid' => 'varchar(64) NOT NULL',
            'start' => 'int',
            'end' => 'int',
            'category' => 'varchar(64)',
            'summary' => 'varchar(255)',
            'description' => 'text',
            'location' => 'varchar(64)',
            'create_time' => 'int NOT NULL',
            'update_time' => 'int NOT NULL',
            'PRIMARY KEY (uid)',
        ));
        $this->createIndex('tbl_event_uid_unique', 'tbl_event', 'uid', true);
    }

    public function down()
    {
        $this->dropTable('tbl_event');
    }

    /*
    // Use safeUp/safeDown to do migration with transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}