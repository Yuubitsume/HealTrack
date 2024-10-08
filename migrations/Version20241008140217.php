<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008140217 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE exercice_maladie (exercice_id INT NOT NULL, maladie_id INT NOT NULL, INDEX IDX_507F74E689D40298 (exercice_id), INDEX IDX_507F74E6B4B1C397 (maladie_id), PRIMARY KEY(exercice_id, maladie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE maladie_exercice (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE exercice_maladie ADD CONSTRAINT FK_507F74E689D40298 FOREIGN KEY (exercice_id) REFERENCES exercice (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE exercice_maladie ADD CONSTRAINT FK_507F74E6B4B1C397 FOREIGN KEY (maladie_id) REFERENCES maladie (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE exercice_maladie DROP FOREIGN KEY FK_507F74E689D40298');
        $this->addSql('ALTER TABLE exercice_maladie DROP FOREIGN KEY FK_507F74E6B4B1C397');
        $this->addSql('DROP TABLE exercice_maladie');
        $this->addSql('DROP TABLE maladie_exercice');
    }
}
