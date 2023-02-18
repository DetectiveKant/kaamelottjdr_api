<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218164428 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE job_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE job_resource (id INT NOT NULL, job_id INT NOT NULL, resource_id INT DEFAULT NULL, level INT NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_DBD6516DBE04EA9 ON job_resource (job_id)');
        $this->addSql('CREATE INDEX IDX_DBD6516D89329D25 ON job_resource (resource_id)');
        $this->addSql('ALTER TABLE job_resource ADD CONSTRAINT FK_DBD6516DBE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE job_resource ADD CONSTRAINT FK_DBD6516D89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE job_resource_id_seq CASCADE');
        $this->addSql('ALTER TABLE job_resource DROP CONSTRAINT FK_DBD6516DBE04EA9');
        $this->addSql('ALTER TABLE job_resource DROP CONSTRAINT FK_DBD6516D89329D25');
        $this->addSql('DROP TABLE job_resource');
    }
}
