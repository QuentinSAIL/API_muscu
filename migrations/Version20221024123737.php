<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221024123737 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle CHANGE region_id_id region_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD public_path VARCHAR(255) NOT NULL, ADD mime_type VARCHAR(50) NOT NULL, ADD status VARCHAR(20) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE muscle CHANGE region_id_id region_id_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture DROP public_path, DROP mime_type, DROP status');
    }
}
