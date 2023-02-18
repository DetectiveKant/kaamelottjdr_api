<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218163436 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE race_ability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE race_ability (id INT NOT NULL, race_id INT NOT NULL, ability_id INT NOT NULL, level INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2A7F3B4C6E59D40D ON race_ability (race_id)');
        $this->addSql('CREATE INDEX IDX_2A7F3B4C8016D8B2 ON race_ability (ability_id)');
        $this->addSql('ALTER TABLE race_ability ADD CONSTRAINT FK_2A7F3B4C6E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE race_ability ADD CONSTRAINT FK_2A7F3B4C8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE race_ability_id_seq CASCADE');
        $this->addSql('ALTER TABLE race_ability DROP CONSTRAINT FK_2A7F3B4C6E59D40D');
        $this->addSql('ALTER TABLE race_ability DROP CONSTRAINT FK_2A7F3B4C8016D8B2');
        $this->addSql('DROP TABLE race_ability');
    }
}
