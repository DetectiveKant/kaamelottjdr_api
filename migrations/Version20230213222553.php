<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230213222553 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE unit_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE unit (id INT NOT NULL, level INT NOT NULL, name VARCHAR(255) NOT NULL, age INT DEFAULT NULL, background TEXT DEFAULT NULL, gender VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE unit_player (unit_id INT NOT NULL, player_id INT NOT NULL, PRIMARY KEY(unit_id, player_id))');
        $this->addSql('CREATE INDEX IDX_F409193F8BD700D ON unit_player (unit_id)');
        $this->addSql('CREATE INDEX IDX_F40919399E6F5DF ON unit_player (player_id)');
        $this->addSql('ALTER TABLE unit_player ADD CONSTRAINT FK_F409193F8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_player ADD CONSTRAINT FK_F40919399E6F5DF FOREIGN KEY (player_id) REFERENCES player (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE unit_id_seq CASCADE');
        $this->addSql('ALTER TABLE unit_player DROP CONSTRAINT FK_F409193F8BD700D');
        $this->addSql('ALTER TABLE unit_player DROP CONSTRAINT FK_F40919399E6F5DF');
        $this->addSql('DROP TABLE unit');
        $this->addSql('DROP TABLE unit_player');
    }
}
