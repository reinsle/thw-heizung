<?php

class m131224_122015_create_events_table extends CDbMigration
{
	public function up()
	{
        $this->createTable('tbl_events', array(
            'uid' => 'varchar(64) NOT NULL',
            'dtstamp' => 'datetime',
            'dtstart' => 'datetime',
            'dtend' => 'datetime',
            'category' => 'varchar(64)',
            'summary' => 'varchar(255)',
            'description' => 'text',
            'location' => 'varchar(64)',
            'PRIMARY KEY (uid)',
        ));
        $this->createIndex('uid_unique', 'tbl_events', 'uid', true);
	}

	public function down()
	{
        $this->dropTable('events');
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
