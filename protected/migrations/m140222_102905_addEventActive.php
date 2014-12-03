<?php

class m140222_102905_addEventActive extends CDbMigration
{
    public function safeUp()
    {
        $this->addColumn('tbl_event', 'active', 'boolean NOT NULL DEFAULT 1');
    }

    public function safeDown()
    {
        $this->dropColumn('tbl_event', 'active');
    }
}