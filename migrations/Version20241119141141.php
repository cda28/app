<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241119141141 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id SERIAL NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, state VARCHAR(255) DEFAULT NULL, code VARCHAR(255) DEFAULT NULL, country VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, duration SMALLINT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE course_module (course_id INT NOT NULL, module_id INT NOT NULL, PRIMARY KEY(course_id, module_id))');
        $this->addSql('CREATE INDEX IDX_A21CE765591CC992 ON course_module (course_id)');
        $this->addSql('CREATE INDEX IDX_A21CE765AFC2B591 ON course_module (module_id)');
        $this->addSql('CREATE TABLE degree (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, level VARCHAR(255) DEFAULT NULL, speciality VARCHAR(255) DEFAULT NULL, obtained_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN degree.obtained_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE education (id SERIAL NOT NULL, address_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_DB0A5ED2F5B7AF75 ON education (address_id)');
        $this->addSql('CREATE TABLE education_course (education_id INT NOT NULL, course_id INT NOT NULL, PRIMARY KEY(education_id, course_id))');
        $this->addSql('CREATE INDEX IDX_5E90D5E82CA1BD71 ON education_course (education_id)');
        $this->addSql('CREATE INDEX IDX_5E90D5E8591CC992 ON education_course (course_id)');
        $this->addSql('CREATE TABLE module (id SERIAL NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, content TEXT DEFAULT NULL, repository_link VARCHAR(255) DEFAULT NULL, module_order SMALLINT DEFAULT NULL, duration SMALLINT DEFAULT NULL, is_updated BOOLEAN DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE rating (id SERIAL NOT NULL, module_id INT DEFAULT NULL, user_rating_id INT DEFAULT NULL, score SMALLINT DEFAULT NULL, comment TEXT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D8892622AFC2B591 ON rating (module_id)');
        $this->addSql('CREATE INDEX IDX_D8892622AD26222 ON rating (user_rating_id)');
        $this->addSql('CREATE TABLE title (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE title_education (title_id INT NOT NULL, education_id INT NOT NULL, PRIMARY KEY(title_id, education_id))');
        $this->addSql('CREATE INDEX IDX_7AF25619A9F87BD ON title_education (title_id)');
        $this->addSql('CREATE INDEX IDX_7AF256192CA1BD71 ON title_education (education_id)');
        $this->addSql('CREATE TABLE "user" (id SERIAL NOT NULL, address_id INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) DEFAULT NULL, email VARCHAR(100) DEFAULT NULL, password VARCHAR(255) DEFAULT NULL, roles JSON NOT NULL, presence VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649F5B7AF75 ON "user" (address_id)');
        $this->addSql('CREATE TABLE user_degree (user_id INT NOT NULL, degree_id INT NOT NULL, PRIMARY KEY(user_id, degree_id))');
        $this->addSql('CREATE INDEX IDX_C2F1765EA76ED395 ON user_degree (user_id)');
        $this->addSql('CREATE INDEX IDX_C2F1765EB35C5756 ON user_degree (degree_id)');
        $this->addSql('CREATE TABLE user_education (user_id INT NOT NULL, education_id INT NOT NULL, PRIMARY KEY(user_id, education_id))');
        $this->addSql('CREATE INDEX IDX_DBEAD336A76ED395 ON user_education (user_id)');
        $this->addSql('CREATE INDEX IDX_DBEAD3362CA1BD71 ON user_education (education_id)');
        $this->addSql('CREATE TABLE user_detail (id SERIAL NOT NULL, user_info_id INT DEFAULT NULL, cv VARCHAR(100) NOT NULL, bio TEXT DEFAULT NULL, github_link VARCHAR(255) DEFAULT NULL, personal_website VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4B5464AE586DFF2 ON user_detail (user_info_id)');
        $this->addSql('CREATE TABLE user_module_planning (id SERIAL NOT NULL, module_id INT DEFAULT NULL, user_module_id INT DEFAULT NULL, confirmed VARCHAR(255) DEFAULT NULL, start_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, end_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_A2850087AFC2B591 ON user_module_planning (module_id)');
        $this->addSql('CREATE INDEX IDX_A2850087AF223875 ON user_module_planning (user_module_id)');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course_module ADD CONSTRAINT FK_A21CE765AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE education ADD CONSTRAINT FK_DB0A5ED2F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE education_course ADD CONSTRAINT FK_5E90D5E82CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE education_course ADD CONSTRAINT FK_5E90D5E8591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE rating ADD CONSTRAINT FK_D8892622AD26222 FOREIGN KEY (user_rating_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE title_education ADD CONSTRAINT FK_7AF25619A9F87BD FOREIGN KEY (title_id) REFERENCES title (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE title_education ADD CONSTRAINT FK_7AF256192CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE "user" ADD CONSTRAINT FK_8D93D649F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_degree ADD CONSTRAINT FK_C2F1765EA76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_degree ADD CONSTRAINT FK_C2F1765EB35C5756 FOREIGN KEY (degree_id) REFERENCES degree (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_education ADD CONSTRAINT FK_DBEAD336A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_education ADD CONSTRAINT FK_DBEAD3362CA1BD71 FOREIGN KEY (education_id) REFERENCES education (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_detail ADD CONSTRAINT FK_4B5464AE586DFF2 FOREIGN KEY (user_info_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_module_planning ADD CONSTRAINT FK_A2850087AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE user_module_planning ADD CONSTRAINT FK_A2850087AF223875 FOREIGN KEY (user_module_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE course_module DROP CONSTRAINT FK_A21CE765591CC992');
        $this->addSql('ALTER TABLE course_module DROP CONSTRAINT FK_A21CE765AFC2B591');
        $this->addSql('ALTER TABLE education DROP CONSTRAINT FK_DB0A5ED2F5B7AF75');
        $this->addSql('ALTER TABLE education_course DROP CONSTRAINT FK_5E90D5E82CA1BD71');
        $this->addSql('ALTER TABLE education_course DROP CONSTRAINT FK_5E90D5E8591CC992');
        $this->addSql('ALTER TABLE rating DROP CONSTRAINT FK_D8892622AFC2B591');
        $this->addSql('ALTER TABLE rating DROP CONSTRAINT FK_D8892622AD26222');
        $this->addSql('ALTER TABLE title_education DROP CONSTRAINT FK_7AF25619A9F87BD');
        $this->addSql('ALTER TABLE title_education DROP CONSTRAINT FK_7AF256192CA1BD71');
        $this->addSql('ALTER TABLE "user" DROP CONSTRAINT FK_8D93D649F5B7AF75');
        $this->addSql('ALTER TABLE user_degree DROP CONSTRAINT FK_C2F1765EA76ED395');
        $this->addSql('ALTER TABLE user_degree DROP CONSTRAINT FK_C2F1765EB35C5756');
        $this->addSql('ALTER TABLE user_education DROP CONSTRAINT FK_DBEAD336A76ED395');
        $this->addSql('ALTER TABLE user_education DROP CONSTRAINT FK_DBEAD3362CA1BD71');
        $this->addSql('ALTER TABLE user_detail DROP CONSTRAINT FK_4B5464AE586DFF2');
        $this->addSql('ALTER TABLE user_module_planning DROP CONSTRAINT FK_A2850087AFC2B591');
        $this->addSql('ALTER TABLE user_module_planning DROP CONSTRAINT FK_A2850087AF223875');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE course_module');
        $this->addSql('DROP TABLE degree');
        $this->addSql('DROP TABLE education');
        $this->addSql('DROP TABLE education_course');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE title');
        $this->addSql('DROP TABLE title_education');
        $this->addSql('DROP TABLE "user"');
        $this->addSql('DROP TABLE user_degree');
        $this->addSql('DROP TABLE user_education');
        $this->addSql('DROP TABLE user_detail');
        $this->addSql('DROP TABLE user_module_planning');
    }
}
