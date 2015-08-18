<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1439875774.
 * Generated on 2015-08-17 22:29:34 by triviski
 */
class PropelMigration_1439875774
{
    public $comment = 'A number of the tables did not have the primary key auto increment.';

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

ALTER TABLE `license`

  CHANGE `licenseId` `licenseId` INTEGER(32) NOT NULL AUTO_INCREMENT;

ALTER TABLE `location`

  CHANGE `locationId` `locationId` INTEGER(32) NOT NULL AUTO_INCREMENT;

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

ALTER TABLE `license`

  CHANGE `licenseId` `licenseId` INTEGER(32) NOT NULL;

ALTER TABLE `location`

  CHANGE `locationId` `locationId` INTEGER(32) NOT NULL;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}
