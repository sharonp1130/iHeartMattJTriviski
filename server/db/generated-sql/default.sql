
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

-- ---------------------------------------------------------------------
-- license
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `license`;

CREATE TABLE `license`
(
    `licenseId` INTEGER(32) NOT NULL,
    `licenseNumber` VARCHAR(32) NOT NULL,
    `service` INTEGER(32) NOT NULL,
    `user` INTEGER(32) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`licenseId`),
    UNIQUE INDEX `licenseId_UNIQUE` (`licenseId`),
    UNIQUE INDEX `licenseNumber_UNIQUE` (`licenseNumber`),
    INDEX `license_servicetype_fk_idx` (`service`),
    INDEX `license_uid_fk_idx` (`user`),
    CONSTRAINT `license_uid_fk`
        FOREIGN KEY (`user`)
        REFERENCES `user` (`userId`)
        ON UPDATE CASCADE,
    CONSTRAINT `license_serv_fk`
        FOREIGN KEY (`service`)
        REFERENCES `service` (`serviceId`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- location
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `location`;

CREATE TABLE `location`
(
    `locationId` INTEGER(32) NOT NULL,
    `user` INTEGER(32) NOT NULL,
    `longitude` DOUBLE NOT NULL,
    `latitude` DOUBLE NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`locationId`),
    UNIQUE INDEX `locationId_UNIQUE` (`locationId`),
    INDEX `location_fk_idx` (`user`),
    CONSTRAINT `location_fk`
        FOREIGN KEY (`user`)
        REFERENCES `user` (`userId`)
        ON UPDATE CASCADE
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- service
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `service`;

CREATE TABLE `service`
(
    `serviceId` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `description` VARCHAR(100) NOT NULL,
    PRIMARY KEY (`serviceId`),
    UNIQUE INDEX `description_UNIQUE` (`description`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- user
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user`
(
    `userId` INTEGER(32) NOT NULL AUTO_INCREMENT,
    `isProvider` TINYINT(1) DEFAULT 0 NOT NULL,
    `userName` VARCHAR(32) NOT NULL,
    `firstName` VARCHAR(20) NOT NULL,
    `lastName` VARCHAR(20) NOT NULL,
    `suffix` VARCHAR(5),
    `address` VARCHAR(64) NOT NULL,
    `phoneNumber` VARCHAR(20) NOT NULL,
    `email` VARCHAR(50) NOT NULL,
    `created_at` DATETIME,
    `updated_at` DATETIME,
    PRIMARY KEY (`userId`),
    UNIQUE INDEX `typeId_UNIQUE` (`userId`),
    UNIQUE INDEX `userName_UNIQUE` (`userName`)
) ENGINE=InnoDB;

-- ---------------------------------------------------------------------
-- userSettings
-- ---------------------------------------------------------------------

DROP TABLE IF EXISTS `userSettings`;

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
