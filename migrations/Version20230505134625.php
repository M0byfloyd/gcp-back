<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230505134625 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create first schema';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE form_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE input_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE question_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE response_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE form (id INT NOT NULL, owner_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5288FD4F7E3C61F9 ON form (owner_id)');
        $this->addSql('CREATE TABLE input (id INT NOT NULL, form_id INT NOT NULL, question_id INT DEFAULT NULL, response_id INT DEFAULT NULL, value BOOLEAN NOT NULL, user_value BOOLEAN NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D82832D75FF69B7D ON input (form_id)');
        $this->addSql('CREATE INDEX IDX_D82832D71E27F6BF ON input (question_id)');
        $this->addSql('CREATE INDEX IDX_D82832D7FBF32840 ON input (response_id)');
        $this->addSql('CREATE TABLE question (id INT NOT NULL, title VARCHAR(255) NOT NULL, points INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE response (id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, firstname VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, title VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE form ADD CONSTRAINT FK_5288FD4F7E3C61F9 FOREIGN KEY (owner_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D75FF69B7D FOREIGN KEY (form_id) REFERENCES form (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D71E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE input ADD CONSTRAINT FK_D82832D7FBF32840 FOREIGN KEY (response_id) REFERENCES response (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE form_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE input_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE question_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE response_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('ALTER TABLE form DROP CONSTRAINT FK_5288FD4F7E3C61F9');
        $this->addSql('ALTER TABLE input DROP CONSTRAINT FK_D82832D75FF69B7D');
        $this->addSql('ALTER TABLE input DROP CONSTRAINT FK_D82832D71E27F6BF');
        $this->addSql('ALTER TABLE input DROP CONSTRAINT FK_D82832D7FBF32840');
        $this->addSql('DROP TABLE form');
        $this->addSql('DROP TABLE input');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE response');
        $this->addSql('DROP TABLE "user"');
    }
}
