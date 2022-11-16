<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221115134305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE test_entity');
        $this->addSql('ALTER TABLE muscle ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE muscle ADD CONSTRAINT FK_F31119EF98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_F31119EF98260155 ON muscle (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle DROP FOREIGN KEY FK_F31119EF98260155');
        $this->addSql('CREATE TABLE test_entity (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP INDEX IDX_F31119EF98260155 ON muscle');
        $this->addSql('ALTER TABLE muscle DROP region_id');
    }
}
