<?php

use Phinx\Migration\AbstractMigration;

class BluzData extends AbstractMigration
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
        $this->query(
            "insert  into `acl_privileges`(`roleId`,`module`,`privilege`) values
                (1,'acl','Edit'),
                (1,'acl','Management'),
                (1,'acl','View'),
                (1,'api','ViewAllRoutes'),
                (1,'cache','Management'),
                (1,'categories','Management'),
                (1,'dashboard','Dashboard'),
                (1,'media','Management'),
                (1,'media','Upload'),
                (1,'options','Management'),
                (1,'pages','Management'),
                (1,'system','Info'),
                (1,'tracks','UploadTrack'),
                (1,'tracks','ViewTracks'),
                (1,'users','Management'),
                (1,'users','ViewProfile'),
                (2,'api','ViewAllRoutes'),
                (2,'media','Upload'),
                (2,'tracks','UploadTrack'),
                (2,'tracks','ViewTracks'),
                (2,'users','ViewProfile'),
                (3,'users','ViewProfile');

            insert  into `acl_roles`(`id`,`name`,`created`) values
                (1,'admin','2012-11-09 07:37:31'),
                (2,'member','2012-11-09 07:37:37'),
                (3,'guest','2012-11-09 07:37:44');

            insert  into `acl_users_roles`(`userId`,`roleId`) values
                (1,1),
                (2,2);

            insert  into `auth`(`userId`,`provider`,`foreignKey`,`token`,`tokenSecret`,`tokenType`,`created`,`updated`)
                values
                (1,'equals','admin','f9705d72d58b2a305ab6f5913ba60a61','secretsalt','access','2012-11-09 07:40:46','0000-00-00 00:00:00'),
                (2,'equals','user','f9705d72d58b2a305ab6f5913ba60a61','secretsalt','access','2014-07-02 18:38:08','0000-00-00 00:00:00');

            insert  into `pages`(`id`,`title`,`alias`,`content`,`keywords`,`description`,`created`,`updated`,`userId`)
                values
                (1,'About Bluz Framework','about','<p>Bluz Lightweight PHP Framework!</p>','about bluz framework','About Bluz','2012-04-09 18:34:03','2014-05-12 11:01:03',0);

            insert  into `users`(`id`,`login`,`email`,`created`,`updated`,`status`) values
                (0,'system',NULL,'2012-11-09 07:37:58','2014-07-01 12:37:48','disabled'),
                (1,'admin',NULL,'2012-11-09 07:38:41','2014-07-01 12:37:48','active'),
                (2,'user',NULL,'2014-07-02 18:36:31','0000-00-00 00:00:00','active');

            insert  into `users_actions`(`userId`,`code`,`action`,`params`,`created`,`expired`) values
                (2,'ceaf243df5ca8b9913c7efccc16e1ef6','recovery','a:0:{}','2014-07-02 18:37:28','2014-07-07 18:37:28');
            "
        );
    }

    /**
     * Migrate Down.
     */
    public function down()
    {
        $this->query("
            delete from `users_actions`;
            delete from `users`;
            delete from `pages`;
            delete from `auth`;
            delete from `acl_users_roles`;
            delete from `acl_roles`;
            delete from `acl_privileges`;
        ");
    }
}