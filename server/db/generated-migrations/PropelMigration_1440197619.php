<?php

/**
 * Data object containing the SQL and PHP code to migrate the database
 * up to version 1440197619.
 * Generated on 2015-08-21 15:53:39 by triviski
 */
class PropelMigration_1440197619
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

DROP TABLE IF EXISTS `userSettings`;

ALTER TABLE `user`

  ADD `phoneOk` TINYINT(1) DEFAULT 1 NOT NULL AFTER `phoneNumber`,

  ADD `textOk` TINYINT(1) DEFAULT 1 NOT NULL AFTER `phoneOk`,

  ADD `emailOk` TINYINT(1) DEFAULT 1 NOT NULL AFTER `textOk`,

  ADD `mondayStart` DATETIME AFTER `emailOk`,

  ADD `mondayEnd` DATETIME AFTER `mondayStart`,

  ADD `tuesdayStart` DATETIME AFTER `mondayEnd`,

  ADD `tuesdayEnd` DATETIME AFTER `tuesdayStart`,

  ADD `wednesdayStart` DATETIME AFTER `tuesdayEnd`,

  ADD `wednesdayEnd` DATETIME AFTER `wednesdayStart`,

  ADD `thursdayStart` DATETIME AFTER `wednesdayEnd`,

  ADD `thursdayEnd` DATETIME AFTER `thursdayStart`,

  ADD `fridayStart` DATETIME AFTER `thursdayEnd`,

  ADD `fridayEnd` DATETIME AFTER `fridayStart`,

  ADD `saturdayStart` DATETIME AFTER `fridayEnd`,

  ADD `saturdayEnd` DATETIME AFTER `saturdayStart`,

  ADD `sundayStart` DATETIME AFTER `saturdayEnd`,

  ADD `sundayEnd` DATETIME AFTER `sundayStart`;

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

  DROP `phoneOk`,

  DROP `textOk`,

  DROP `emailOk`,

  DROP `mondayStart`,

  DROP `mondayEnd`,

  DROP `tuesdayStart`,

  DROP `tuesdayEnd`,

  DROP `wednesdayStart`,

  DROP `wednesdayEnd`,

  DROP `thursdayStart`,

  DROP `thursdayEnd`,

  DROP `fridayStart`,

  DROP `fridayEnd`,

  DROP `saturdayStart`,

  DROP `saturdayEnd`,

  DROP `sundayStart`,

  DROP `sundayEnd`;

CREATE TABLE `userSettings`
(
    `settingsId` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `user` INTEGER(32) NOT NULL,
    `phoneOk` TINYINT(1) DEFAULT 1 NOT NULL,
    `textOk` TINYINT(1) DEFAULT 1 NOT NULL,
    `emailOk` TINYINT(1) DEFAULT 1 NOT NULL,
    `mondayStart` DATETIME,
    `mondayEnd` DATETIME,
    `tuesdayStart` DATETIME,
    `tuesdayEnd` DATETIME,
    `wednesdayStart` DATETIME,
    `wednesdayEnd` DATETIME,
    `thursdayStart` DATETIME,
    `thursdayEnd` DATETIME,
    `fridayStart` DATETIME,
    `fridayEnd` DATETIME,
    `saturdayStart` DATETIME,
    `saturdayEnd` DATETIME,
    `sundayStart` DATETIME,
    `sundayEnd` DATETIME,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`settingsId`),
    INDEX `nhh_idx` (`user`),
    CONSTRAINT `usersettings_fk`
        FOREIGN KEY (`user`)
        REFERENCES `user` (`userId`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
',
);
    }

}