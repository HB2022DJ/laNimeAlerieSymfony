<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220727194152 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket ADD basket_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B63C9C38C FOREIGN KEY (basket_user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_2246507B63C9C38C ON basket (basket_user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B63C9C38C');
        $this->addSql('DROP INDEX IDX_2246507B63C9C38C ON basket');
        $this->addSql('ALTER TABLE basket DROP basket_user_id');
    }
}
