<?php

use Phinx\Migration\AbstractMigration;

class CreatePointsTable extends AbstractMigration
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
            CREATE TABLE `points` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `trackId` int(11) NOT NULL,
              `latitude` decimal(16,12) NOT NULL,
              `longitude` decimal(16,12) NOT NULL,
              `altitude` decimal(16,12) NOT NULL,
              `datetime` datetime NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
        ');
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query('DROP TABLE `points`');
    }
}