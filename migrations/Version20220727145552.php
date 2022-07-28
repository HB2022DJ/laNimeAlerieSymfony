<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727145552 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contain ADD contain_basket_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C8D37EAC07 FOREIGN KEY (contain_basket_id) REFERENCES basket (id)');
        $this->addSql('CREATE INDEX IDX_4BEFF7C8D37EAC07 ON contain (contain_basket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contain DROP FOREIGN KEY FK_4BEFF7C8D37EAC07');
        $this->addSql('DROP INDEX IDX_4BEFF7C8D37EAC07 ON contain');
        $this->addSql('ALTER TABLE contain DROP contain_basket_id');
    }
}
