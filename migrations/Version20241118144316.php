<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118144316 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, first_name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE user_detail (id SERIAL NOT NULL, user_info_id INT DEFAULT NULL, cv VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B5464AE586DFF2 ON user_detail (user_info_id)');
        $this->addSql('ALTER TABLE user_detail ADD CONSTRAINT FK_4B5464AE586DFF2 FOREIGN KEY (user_info_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE user_detail DROP CONSTRAINT FK_4B5464AE586DFF2');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_detail');
    }
}
