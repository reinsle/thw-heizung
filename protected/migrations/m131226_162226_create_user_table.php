<?php

class m131226_162226_create_user_table extends CDbMigration
{
    public function up()
    {
        date_default_timezone_set('Europe/Berlin');
        $this->createTable('tbl_user', array(
            'id' => 'pk',
            'email' => 'varchar(128) NOT NULL',
            'password' => 'varchar(128) NOT NULL',
            'create_time' => 'int NOT NULL',
            'update_time' => 'int NOT NULL',
            'last_login_time' => 'int',
        ));
        $this->createIndex('tbl_user_email_unique', 'tbl_user', 'email', true);
        $this->insert('tbl_user', array(
            "email" => "admin@einsle.de",
            "password" => sha1("ni.xd.ol"),
            "create_time" => strtotime('now'),
            "update_time" => strtotime('now'),
        ));
    }

    public function down()
    {
        $this->dropTable('tbl_user');
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
