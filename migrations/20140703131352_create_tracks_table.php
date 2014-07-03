<?php

use Phinx\Migration\AbstractMigration;

class CreateTracksTable extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     *
     * Uncomment this method if you would like to use it.
     *
    public function change()
    {
    }
    */
    
    /**
     * Migrate Up.
     */
    public function up()
    {
        $this->query('
            CREATE TABLE `tracks` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `userId` int(11) NOT NULL,
              `creator` text COLLATE utf8_bin NOT NULL,
              `time` datetime NOT NULL,
              `hash` varchar(32) COLLATE utf8_bin NOT NULL,
              `timeCreated` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query('DROP TABLE `tracks`');
    }
}