<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Added provider info entity class.  Also changed the custom providerId field to be just named id to make life simple.`
 */
class Version20151008221638 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE provider_info (id INT AUTO_INCREMENT NOT NULL, phoneOk TINYINT(1) NOT NULL, textOk TINYINT(1) NOT NULL, emailOk TINYINT(1) NOT NULL, provider INT NOT NULL, mondayStart TIME NOT NULL, mondayEnd TIME NOT NULL, tuesdayStart TIME NOT NULL, tuesdayEnd TIME NOT NULL, wednesdayStart TIME NOT NULL, wednsesdayEnd TIME NOT NULL, thursdayStart TIME NOT NULL, thursdayEnd TIME NOT NULL, fridayStart TIME NOT NULL, fridayEnd TIME NOT NULL, saturdayStart TIME NOT NULL, saturdayEnd TIME NOT NULL, sundayStart TIME NOT NULL, sundayEnd TIME NOT NULL, created DATETIME NOT NULL, lastModified DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE provider_info');
    }
}
