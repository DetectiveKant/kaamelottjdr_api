<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230218165017 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE unit_ability (unit_id INT NOT NULL, ability_id INT NOT NULL, PRIMARY KEY(unit_id, ability_id))');
        $this->addSql('CREATE INDEX IDX_6186E0FEF8BD700D ON unit_ability (unit_id)');
        $this->addSql('CREATE INDEX IDX_6186E0FE8016D8B2 ON unit_ability (ability_id)');
        $this->addSql('ALTER TABLE unit_ability ADD CONSTRAINT FK_6186E0FEF8BD700D FOREIGN KEY (unit_id) REFERENCES unit (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit_ability ADD CONSTRAINT FK_6186E0FE8016D8B2 FOREIGN KEY (ability_id) REFERENCES ability (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit ADD race_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unit ADD job_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C536E59D40D FOREIGN KEY (race_id) REFERENCES race (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE unit ADD CONSTRAINT FK_DCBB0C53BE04EA9 FOREIGN KEY (job_id) REFERENCES job (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_DCBB0C536E59D40D ON unit (race_id)');
        $this->addSql('CREATE INDEX IDX_DCBB0C53BE04EA9 ON unit (job_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE unit_ability DROP CONSTRAINT FK_6186E0FEF8BD700D');
        $this->addSql('ALTER TABLE unit_ability DROP CONSTRAINT FK_6186E0FE8016D8B2');
        $this->addSql('DROP TABLE unit_ability');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C536E59D40D');
        $this->addSql('ALTER TABLE unit DROP CONSTRAINT FK_DCBB0C53BE04EA9');
        $this->addSql('DROP INDEX IDX_DCBB0C536E59D40D');
        $this->addSql('DROP INDEX IDX_DCBB0C53BE04EA9');
        $this->addSql('ALTER TABLE unit DROP race_id');
        $this->addSql('ALTER TABLE unit DROP job_id');
    }
}
