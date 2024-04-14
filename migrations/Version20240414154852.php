<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240414154852 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE hair DROP FOREIGN KEY FK_9CF76119B3F6398B');
        $this->addSql('DROP INDEX UNIQ_9CF76119B3F6398B ON hair');
        $this->addSql('ALTER TABLE hair DROP physical_traits_id');
        $this->addSql('ALTER TABLE physical_traits ADD hair_id INT NOT NULL');
        $this->addSql('ALTER TABLE physical_traits ADD CONSTRAINT FK_5D54C37A2A89600A FOREIGN KEY (hair_id) REFERENCES hair (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_5D54C37A2A89600A ON physical_traits (hair_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE physical_traits DROP FOREIGN KEY FK_5D54C37A2A89600A');
        $this->addSql('DROP INDEX UNIQ_5D54C37A2A89600A ON physical_traits');
        $this->addSql('ALTER TABLE physical_traits DROP hair_id');
        $this->addSql('ALTER TABLE hair ADD physical_traits_id INT NOT NULL');
        $this->addSql('ALTER TABLE hair ADD CONSTRAINT FK_9CF76119B3F6398B FOREIGN KEY (physical_traits_id) REFERENCES physical_traits (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9CF76119B3F6398B ON hair (physical_traits_id)');
    }
}
