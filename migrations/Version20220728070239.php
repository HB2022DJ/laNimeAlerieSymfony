<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220728070239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item_product_basket');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_product_basket (item_product_id INT NOT NULL, basket_id INT NOT NULL, INDEX IDX_51D7B62BF8354E50 (item_product_id), INDEX IDX_51D7B62B1BE1FB52 (basket_id), PRIMARY KEY(item_product_id, basket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE item_product_basket ADD CONSTRAINT FK_51D7B62B1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_product_basket ADD CONSTRAINT FK_51D7B62BF8354E50 FOREIGN KEY (item_product_id) REFERENCES item_product (id) ON DELETE CASCADE');
    }
}
