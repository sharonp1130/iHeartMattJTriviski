<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1441656072.
 * Generated on 2015-09-07 13:01:12 by triviski
 */
class PropelMigration_1441656072
{
    public $comment = '';

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

ALTER TABLE `user`

  CHANGE `mondayStart` `mondayStart` TIME,

  CHANGE `mondayEnd` `mondayEnd` TIME,

  CHANGE `tuesdayStart` `tuesdayStart` TIME,

  CHANGE `tuesdayEnd` `tuesdayEnd` TIME,

  CHANGE `wednesdayStart` `wednesdayStart` TIME,

  CHANGE `wednesdayEnd` `wednesdayEnd` TIME,

  CHANGE `thursdayStart` `thursdayStart` TIME,

  CHANGE `thursdayEnd` `thursdayEnd` TIME,

  CHANGE `fridayStart` `fridayStart` TIME,

  CHANGE `fridayEnd` `fridayEnd` TIME,

  CHANGE `saturdayStart` `saturdayStart` TIME,

  CHANGE `saturdayEnd` `saturdayEnd` TIME,

  CHANGE `sundayStart` `sundayStart` TIME,

  CHANGE `sundayEnd` `sundayEnd` TIME;

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

ALTER TABLE `user`

  CHANGE `mondayStart` `mondayStart` DATETIME,

  CHANGE `mondayEnd` `mondayEnd` DATETIME,

  CHANGE `tuesdayStart` `tuesdayStart` DATETIME,

  CHANGE `tuesdayEnd` `tuesdayEnd` DATETIME,

  CHANGE `wednesdayStart` `wednesdayStart` DATETIME,

  CHANGE `wednesdayEnd` `wednesdayEnd` DATETIME,

  CHANGE `thursdayStart` `thursdayStart` DATETIME,

  CHANGE `thursdayEnd` `thursdayEnd` DATETIME,

  CHANGE `fridayStart` `fridayStart` DATETIME,

  CHANGE `fridayEnd` `fridayEnd` DATETIME,

  CHANGE `saturdayStart` `saturdayStart` DATETIME,

  CHANGE `saturdayEnd` `saturdayEnd` DATETIME,

  CHANGE `sundayStart` `sundayStart` DATETIME,

  CHANGE `sundayEnd` `sundayEnd` DATETIME;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}