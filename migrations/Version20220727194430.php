<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727194430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user ADD user_postal_address_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64954B2E60 FOREIGN KEY (user_postal_address_id) REFERENCES postal_address (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64954B2E60 ON user (user_postal_address_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64954B2E60');
        $this->addSql('DROP INDEX IDX_8D93D64954B2E60 ON user');
        $this->addSql('ALTER TABLE user DROP user_postal_address_id');
    }
}
