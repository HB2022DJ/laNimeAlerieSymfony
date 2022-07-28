<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727141959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_product ADD item_brand_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE item_product ADD CONSTRAINT FK_D81722F928F818C3 FOREIGN KEY (item_brand_id) REFERENCES brand (id)');
        $this->addSql('CREATE INDEX IDX_D81722F928F818C3 ON item_product (item_brand_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_product DROP FOREIGN KEY FK_D81722F928F818C3');
        $this->addSql('DROP INDEX IDX_D81722F928F818C3 ON item_product');
        $this->addSql('ALTER TABLE item_product DROP item_brand_id');
    }
}
