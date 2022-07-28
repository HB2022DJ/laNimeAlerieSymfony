<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727185827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contain ADD contain_item_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE contain ADD CONSTRAINT FK_4BEFF7C854DAF2C5 FOREIGN KEY (contain_item_product_id) REFERENCES item_product (id)');
        $this->addSql('CREATE INDEX IDX_4BEFF7C854DAF2C5 ON contain (contain_item_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE contain DROP FOREIGN KEY FK_4BEFF7C854DAF2C5');
        $this->addSql('DROP INDEX IDX_4BEFF7C854DAF2C5 ON contain');
        $this->addSql('ALTER TABLE contain DROP contain_item_product_id');
    }
}
