<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241118162517 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE "user" ADD last_name VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD email VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD password VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD roles JSON NOT NULL');
        $this->addSql('ALTER TABLE "user" ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE "user" ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE user_detail ADD bio TEXT DEFAULT NULL');
        $this->addSql('ALTER TABLE user_detail ADD github_link VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_detail ADD personal_website VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE user_detail ADD created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE user_detail ADD updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE "user" DROP last_name');
        $this->addSql('ALTER TABLE "user" DROP email');
        $this->addSql('ALTER TABLE "user" DROP password');
        $this->addSql('ALTER TABLE "user" DROP roles');
        $this->addSql('ALTER TABLE "user" DROP created_at');
        $this->addSql('ALTER TABLE "user" DROP updated_at');
        $this->addSql('ALTER TABLE user_detail DROP bio');
        $this->addSql('ALTER TABLE user_detail DROP github_link');
        $this->addSql('ALTER TABLE user_detail DROP personal_website');
        $this->addSql('ALTER TABLE user_detail DROP created_at');
        $this->addSql('ALTER TABLE user_detail DROP updated_at');
    }
}
