<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218162830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE ability_resource_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE ability_resource (id INT NOT NULL, ability_id INT NOT NULL, resource_id INT NOT NULL, value INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A2ECCC9F8016D8B2 ON ability_resource (ability_id)');
        $this->addSql('CREATE INDEX IDX_A2ECCC9F89329D25 ON ability_resource (resource_id)');
        $this->addSql('ALTER TABLE ability_resource ADD CONSTRAINT FK_A2ECCC9F8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE ability_resource ADD CONSTRAINT FK_A2ECCC9F89329D25 FOREIGN KEY (resource_id) REFERENCES resource (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE ability_resource_id_seq CASCADE');
        $this->addSql('ALTER TABLE ability_resource DROP CONSTRAINT FK_A2ECCC9F8016D8B2');
        $this->addSql('ALTER TABLE ability_resource DROP CONSTRAINT FK_A2ECCC9F89329D25');
        $this->addSql('DROP TABLE ability_resource');
    }
}
