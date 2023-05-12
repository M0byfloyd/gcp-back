<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512134052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE input DROP CONSTRAINT fk_d82832d7fbf32840');
        $this->addSql('DROP SEQUENCE response_id_seq CASCADE');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP INDEX idx_d82832d7fbf32840');
        $this->addSql('ALTER TABLE input DROP response_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE SEQUENCE response_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE response (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE input ADD response_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT fk_d82832d7fbf32840 FOREIGN KEY (response_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_d82832d7fbf32840 ON input (response_id)');
    }
}
