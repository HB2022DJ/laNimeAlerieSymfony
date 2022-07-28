<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727141354 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture_path ADD item_product_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picture_path ADD CONSTRAINT FK_B4B40E9AF8354E50 FOREIGN KEY (item_product_id) REFERENCES item_product (id)');
        $this->addSql('CREATE INDEX IDX_B4B40E9AF8354E50 ON picture_path (item_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picture_path DROP FOREIGN KEY FK_B4B40E9AF8354E50');
        $this->addSql('DROP INDEX IDX_B4B40E9AF8354E50 ON picture_path');
        $this->addSql('ALTER TABLE picture_path DROP item_product_id');
    }
}
