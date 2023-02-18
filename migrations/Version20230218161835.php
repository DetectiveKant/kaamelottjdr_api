<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218161835 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ability (id INT NOT NULL, name VARCHAR(1023) NOT NULL, description TEXT DEFAULT NULL, action_type VARCHAR(255) DEFAULT NULL, action_count INT DEFAULT NULL, range DOUBLE PRECISION DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE ability_effect (ability_id INT NOT NULL, effect_id INT NOT NULL, PRIMARY KEY(ability_id, effect_id))');
        $this->addSql('CREATE INDEX IDX_A06EB43C8016D8B2 ON ability_effect (ability_id)');
        $this->addSql('CREATE INDEX IDX_A06EB43CF5E9B83B ON ability_effect (effect_id)');
        $this->addSql('ALTER TABLE ability_effect ADD CONSTRAINT FK_A06EB43C8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ability_effect ADD CONSTRAINT FK_A06EB43CF5E9B83B FOREIGN KEY (effect_id) REFERENCES effect (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ability_id_seq CASCADE');
        $this->addSql('ALTER TABLE ability_effect DROP CONSTRAINT FK_A06EB43C8016D8B2');
        $this->addSql('ALTER TABLE ability_effect DROP CONSTRAINT FK_A06EB43CF5E9B83B');
        $this->addSql('DROP TABLE ability');
        $this->addSql('DROP TABLE ability_effect');
    }
}
