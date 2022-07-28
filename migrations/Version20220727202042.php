<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727202042 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ADD basket_status_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507BED407D66 FOREIGN KEY (basket_status_id) REFERENCES status_command (id)');
        $this->addSql('CREATE INDEX IDX_2246507BED407D66 ON basket (basket_status_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507BED407D66');
        $this->addSql('DROP INDEX IDX_2246507BED407D66 ON basket');
        $this->addSql('ALTER TABLE basket DROP basket_status_id');
    }
}
