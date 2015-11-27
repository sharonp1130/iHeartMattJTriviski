DROP DATABASE IF EXISTS `help_me_db`;
CREATE DATABASE IF NOT EXISTS `help_me_db`;

CREATE TABLE `help_me_db`.`user` (
	`userId` INT NOT NULL,
	`info` INT NOT NULL, 
	`settings` INT NOT NULL, 
	`email` VARCHAR(50) NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`userId`)
	);
	
CREATE TABLE `help_me_db`.`info` (
	`infoId` INT NOT NULL,
	`user` INT NOT NULL,
	`address` VARCHAR(64) NOT NULL,
	`city` VARCHAR(64) NOT NULL,
	`zipcode` VARCHAR(5) NOT NULL,
	`phoneNumber` VARCHAR(20) NOT NULL,
	`phoneOk` BIT DEFAULT 1 NOT NULL,
	`textOk` BIT DEFAULT 1 NOT NULL,
	`emailOk` BIT DEFAULT 1 NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`infoId`)
	);
	
CREATE TABLE `help_me_db`.`settings` (
	`settingsId` INT NOT NULL,
	`mondayStart` TIME,
	`mondayEnd` TIME,
	`tuesdayStart` TIME,
	`tuesdayEnd` TIME,
	`wednesdayStart` TIME,
	`wednesdayEnd` TIME,
	`thursdayStart` TIME,
	`thursdayEnd` TIME,
	`fridayStart` TIME,
	`fridayEnd` TIME,
	`saturdayStart` TIME,
	`saturdayEnd` TIME,
	`sundayStart` TIME,
	`sundayEnd` TIME,
	`user` INT NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`settingsId`)
) ENGINE=InnoDB;

CREATE TABLE `help_me_db`.`service` (
	`serviceId` INT NOT NULL,
	`description` VARCHAR(100) NOT NULL,
	PRIMARY KEY (`serviceId`)
) ENGINE=InnoDB;

CREATE TABLE `help_me_db`.`location` (
	`locationId` INT NOT NULL,
	`user` INT NOT NULL,
	`longitude` DOUBLE NOT NULL,
	`latitude` DOUBLE NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`locationId`)
) ENGINE=InnoDB;

CREATE TABLE `help_me_db`.`license` (
	`licenseId` INT NOT NULL,
	`user` INT NOT NULL,
	`licenseNumber` VARCHAR(32) NOT NULL,
	`service` INT NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`licenseId`)
) ENGINE=InnoDB;

CREATE UNIQUE INDEX `description_UNIQUE` ON `help_me_db`.`service` (`description` ASC);

CREATE UNIQUE INDEX `licenseNumber_UNIQUE` ON `help_me_db`.`license` (`licenseNumber` ASC);

CREATE INDEX `license_servicetype_fk_idx` ON `help_me_db`.`license` (`service` ASC);

CREATE UNIQUE INDEX `locationId_UNIQUE` ON `help_me_db`.`location` (`locationId` ASC);

CREATE INDEX `license_uid_fk_idx` ON `help_me_db`.`license` (`user` ASC);

CREATE INDEX `location_fk_idx` ON `help_me_db`.`location` (`user` ASC);

CREATE UNIQUE INDEX `licenseId_UNIQUE` ON `help_me_db`.`license` (`licenseId` ASC);

CREATE UNIQUE INDEX `email_UNIQUE` ON `help_me_db`.`user` (`email` ASC);

CREATE UNIQUE INDEX `typeId_UNIQUE` ON `help_me_db`.`user` (`userId` ASC);

