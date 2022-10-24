<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221007101957 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_muscle (exercice_id INT NOT NULL, muscle_id INT NOT NULL, INDEX IDX_2A9ECEF589D40298 (exercice_id), INDEX IDX_2A9ECEF5354FDBB4 (muscle_id), PRIMARY KEY(exercice_id, muscle_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice_muscle ADD CONSTRAINT FK_2A9ECEF589D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_muscle ADD CONSTRAINT FK_2A9ECEF5354FDBB4 FOREIGN KEY (muscle_id) REFERENCES muscle (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_muscle DROP FOREIGN KEY FK_2A9ECEF589D40298');
        $this->addSql('ALTER TABLE exercice_muscle DROP FOREIGN KEY FK_2A9ECEF5354FDBB4');
        $this->addSql('DROP TABLE exercice_muscle');
    }
}
