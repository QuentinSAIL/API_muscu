<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007104819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle ADD picture_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE muscle ADD CONSTRAINT FK_F31119EFFF9E1919 FOREIGN KEY (picture_id_id) REFERENCES picture (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_F31119EFFF9E1919 ON muscle (picture_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle DROP FOREIGN KEY FK_F31119EFFF9E1919');
        $this->addSql('DROP INDEX UNIQ_F31119EFFF9E1919 ON muscle');
        $this->addSql('ALTER TABLE muscle DROP picture_id_id');
    }
}
