<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241008133116 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE patient_maladie (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, maladie_id INT NOT NULL, INDEX IDX_F0A757A0A76ED395 (user_id), INDEX IDX_F0A757A0B4B1C397 (maladie_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_maladie ADD CONSTRAINT FK_F0A757A0A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE patient_maladie ADD CONSTRAINT FK_F0A757A0B4B1C397 FOREIGN KEY (maladie_id) REFERENCES maladie (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE patient_maladie DROP FOREIGN KEY FK_F0A757A0A76ED395');
        $this->addSql('ALTER TABLE patient_maladie DROP FOREIGN KEY FK_F0A757A0B4B1C397');
        $this->addSql('DROP TABLE patient_maladie');
    }
}
