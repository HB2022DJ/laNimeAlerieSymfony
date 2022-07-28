<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727192055 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category ADD category_category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE category ADD CONSTRAINT FK_64C19C1A5DDDF89 FOREIGN KEY (category_category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_64C19C1A5DDDF89 ON category (category_category_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE category DROP FOREIGN KEY FK_64C19C1A5DDDF89');
        $this->addSql('DROP INDEX IDX_64C19C1A5DDDF89 ON category');
        $this->addSql('ALTER TABLE category DROP category_category_id');
    }
}
