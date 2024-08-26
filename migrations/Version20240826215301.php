<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826215301 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE specialisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE talent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE specialisation (id INT NOT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE talent (id INT NOT NULL, specialisation_id INT DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_16D902F55627D44C ON talent (specialisation_id)');
        $this->addSql('ALTER TABLE talent ADD CONSTRAINT FK_16D902F55627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP SEQUENCE specialisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE talent_id_seq CASCADE');
        $this->addSql('ALTER TABLE talent DROP CONSTRAINT FK_16D902F55627D44C');
        $this->addSql('DROP TABLE specialisation');
        $this->addSql('DROP TABLE talent');
    }
}
