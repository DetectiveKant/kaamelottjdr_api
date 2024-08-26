<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240826213440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT fk_dcbb0c53be04ea9');
        $this->addSql('DROP SEQUENCE job_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE job_resource_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE job_ability_id_seq CASCADE');
        $this->addSql('ALTER TABLE job_ability DROP CONSTRAINT fk_af2059a7be04ea9');
        $this->addSql('ALTER TABLE job_ability DROP CONSTRAINT fk_af2059a78016d8b2');
        $this->addSql('ALTER TABLE job_resource DROP CONSTRAINT fk_dbd6516dbe04ea9');
        $this->addSql('ALTER TABLE job_resource DROP CONSTRAINT fk_dbd6516d89329d25');
        $this->addSql('DROP TABLE job');
        $this->addSql('DROP TABLE job_ability');
        $this->addSql('DROP TABLE job_resource');
        $this->addSql('DROP INDEX idx_dcbb0c53be04ea9');
        $this->addSql('ALTER TABLE unit DROP job_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE job_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE job_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE job_ability_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE job (id INT NOT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE job_ability (id INT NOT NULL, job_id INT NOT NULL, ability_id INT NOT NULL, level INT NOT NULL, is_default BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_af2059a78016d8b2 ON job_ability (ability_id)');
        $this->addSql('CREATE INDEX idx_af2059a7be04ea9 ON job_ability (job_id)');
        $this->addSql('CREATE TABLE job_resource (id INT NOT NULL, job_id INT NOT NULL, resource_id INT DEFAULT NULL, level INT NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_dbd6516d89329d25 ON job_resource (resource_id)');
        $this->addSql('CREATE INDEX idx_dbd6516dbe04ea9 ON job_resource (job_id)');
        $this->addSql('ALTER TABLE job_ability ADD CONSTRAINT fk_af2059a7be04ea9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_ability ADD CONSTRAINT fk_af2059a78016d8b2 FOREIGN KEY (ability_id) REFERENCES ability (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_resource ADD CONSTRAINT fk_dbd6516dbe04ea9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_resource ADD CONSTRAINT fk_dbd6516d89329d25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit ADD job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT fk_dcbb0c53be04ea9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_dcbb0c53be04ea9 ON unit (job_id)');
    }
}
