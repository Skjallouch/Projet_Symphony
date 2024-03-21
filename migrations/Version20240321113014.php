<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240321113014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, id_member_id INT NOT NULL, street VARCHAR(255) NOT NULL, postal_code INT NOT NULL, city VARCHAR(100) NOT NULL, country VARCHAR(50) NOT NULL, INDEX IDX_D4E6F81F5A26FD9 (id_member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE advice (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(100) NOT NULL, advice LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_article (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(150) NOT NULL, content MEDIUMTEXT NOT NULL, author_name VARCHAR(150) NOT NULL, hair_color VARCHAR(50) DEFAULT NULL, hair_length VARCHAR(50) DEFAULT NULL, haircut VARCHAR(100) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blog_article_member (blog_article_id INT NOT NULL, member_id INT NOT NULL, INDEX IDX_5E54C6419452A475 (blog_article_id), INDEX IDX_5E54C6417597D3FE (member_id), PRIMARY KEY(blog_article_id, member_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evaluation_recipe (id INT AUTO_INCREMENT NOT NULL, mark INT NOT NULL, title_comment VARCHAR(255) NOT NULL, comment VARCHAR(1000) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair (id INT AUTO_INCREMENT NOT NULL, is_a_id INT NOT NULL, hair_length VARCHAR(150) NOT NULL, hair_type VARCHAR(150) NOT NULL, decoloration TINYINT(1) NOT NULL, hair_color VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_9CF76119AE2D7D79 (is_a_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair_hair_product (hair_id INT NOT NULL, hair_product_id INT NOT NULL, INDEX IDX_54079F452A89600A (hair_id), INDEX IDX_54079F4547E90CCF (hair_product_id), PRIMARY KEY(hair_id, hair_product_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE hair_product (id INT AUTO_INCREMENT NOT NULL, product_name VARCHAR(150) NOT NULL, hair_type VARCHAR(150) NOT NULL, hair_effect VARCHAR(150) NOT NULL, price DOUBLE PRECISION NOT NULL, stock INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE homemade_recipe (id INT AUTO_INCREMENT NOT NULL, recipe_name VARCHAR(150) NOT NULL, hair_type VARCHAR(150) NOT NULL, effect_hair VARCHAR(150) NOT NULL, preparation LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredient (id INT AUTO_INCREMENT NOT NULL, name_ingredient VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `member` (id INT AUTO_INCREMENT NOT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE physical_traits (id INT AUTO_INCREMENT NOT NULL, face_shape VARCHAR(150) NOT NULL, eye_color VARCHAR(150) NOT NULL, skin_color VARCHAR(150) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recommendation (id INT AUTO_INCREMENT NOT NULL, corresponds_id INT NOT NULL, hair_cut VARCHAR(150) NOT NULL, length VARCHAR(150) NOT NULL, color VARCHAR(150) NOT NULL, INDEX IDX_433224D2F7331948 (corresponds_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F81F5A26FD9 FOREIGN KEY (id_member_id) REFERENCES `member` (id)');
        $this->addSql('ALTER TABLE blog_article_member ADD CONSTRAINT FK_5E54C6419452A475 FOREIGN KEY (blog_article_id) REFERENCES blog_article (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blog_article_member ADD CONSTRAINT FK_5E54C6417597D3FE FOREIGN KEY (member_id) REFERENCES `member` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hair ADD CONSTRAINT FK_9CF76119AE2D7D79 FOREIGN KEY (is_a_id) REFERENCES physical_traits (id)');
        $this->addSql('ALTER TABLE hair_hair_product ADD CONSTRAINT FK_54079F452A89600A FOREIGN KEY (hair_id) REFERENCES hair (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE hair_hair_product ADD CONSTRAINT FK_54079F4547E90CCF FOREIGN KEY (hair_product_id) REFERENCES hair_product (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE recommendation ADD CONSTRAINT FK_433224D2F7331948 FOREIGN KEY (corresponds_id) REFERENCES physical_traits (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F81F5A26FD9');
        $this->addSql('ALTER TABLE blog_article_member DROP FOREIGN KEY FK_5E54C6419452A475');
        $this->addSql('ALTER TABLE blog_article_member DROP FOREIGN KEY FK_5E54C6417597D3FE');
        $this->addSql('ALTER TABLE hair DROP FOREIGN KEY FK_9CF76119AE2D7D79');
        $this->addSql('ALTER TABLE hair_hair_product DROP FOREIGN KEY FK_54079F452A89600A');
        $this->addSql('ALTER TABLE hair_hair_product DROP FOREIGN KEY FK_54079F4547E90CCF');
        $this->addSql('ALTER TABLE recommendation DROP FOREIGN KEY FK_433224D2F7331948');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE advice');
        $this->addSql('DROP TABLE blog_article');
        $this->addSql('DROP TABLE blog_article_member');
        $this->addSql('DROP TABLE evaluation_recipe');
        $this->addSql('DROP TABLE hair');
        $this->addSql('DROP TABLE hair_hair_product');
        $this->addSql('DROP TABLE hair_product');
        $this->addSql('DROP TABLE homemade_recipe');
        $this->addSql('DROP TABLE ingredient');
        $this->addSql('DROP TABLE `member`');
        $this->addSql('DROP TABLE physical_traits');
        $this->addSql('DROP TABLE recommendation');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
