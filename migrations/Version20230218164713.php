<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218164713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE job_ability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE job_ability (id INT NOT NULL, job_id INT NOT NULL, ability_id INT NOT NULL, level INT NOT NULL, is_default BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_AF2059A7BE04EA9 ON job_ability (job_id)');
        $this->addSql('CREATE INDEX IDX_AF2059A78016D8B2 ON job_ability (ability_id)');
        $this->addSql('ALTER TABLE job_ability ADD CONSTRAINT FK_AF2059A7BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_ability ADD CONSTRAINT FK_AF2059A78016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE job_ability_id_seq CASCADE');
        $this->addSql('ALTER TABLE job_ability DROP CONSTRAINT FK_AF2059A7BE04EA9');
        $this->addSql('ALTER TABLE job_ability DROP CONSTRAINT FK_AF2059A78016D8B2');
        $this->addSql('DROP TABLE job_ability');
    }
}
