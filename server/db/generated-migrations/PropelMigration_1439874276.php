<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1439874276.
 * Generated on 2015-08-17 22:04:36 by triviski
 */
class PropelMigration_1439874276
{
    public $comment = 'Removed the username and made the email the main user name.  Split the address into address, city and zip.';

    public function preUp($manager)
    {
        // add the pre-migration code here
    }

    public function postUp($manager)
    {
        // add the post-migration code here
    }

    public function preDown($manager)
    {
        // add the pre-migration code here
    }

    public function postDown($manager)
    {
        // add the post-migration code here
    }

    /**
     * Get the SQL statements for the Up migration
     *
     * @return array list of the SQL strings to execute for the Up migration
     *               the keys being the datasources
     */
    public function getUpSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `userName_UNIQUE` ON `user`;

ALTER TABLE `user`

  ADD `city` VARCHAR(64) NOT NULL AFTER `address`,

  ADD `zipcode` VARCHAR(5) NOT NULL AFTER `city`,

  DROP `userName`;

CREATE UNIQUE INDEX `email_UNIQUE` ON `user` (`email`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

    /**
     * Get the SQL statements for the Down migration
     *
     * @return array list of the SQL strings to execute for the Down migration
     *               the keys being the datasources
     */
    public function getDownSQL()
    {
        return array (
  'default' => '
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

DROP INDEX `email_UNIQUE` ON `user`;

ALTER TABLE `user`

  ADD `userName` VARCHAR(32) NOT NULL AFTER `isProvider`,

  DROP `city`,

  DROP `zipcode`;

CREATE UNIQUE INDEX `userName_UNIQUE` ON `user` (`userName`);

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
