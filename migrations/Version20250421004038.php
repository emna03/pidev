<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250421004038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE tentative_fraude (id INT AUTO_INCREMENT NOT NULL, declaration_id INT NOT NULL, type_fraude VARCHAR(255) NOT NULL, INDEX IDX_5D97E2BC06258A3 (declaration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tentative_fraude ADD CONSTRAINT FK_5D97E2BC06258A3 FOREIGN KEY (declaration_id) REFERENCES declaration_revenus (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tentative_fraude DROP FOREIGN KEY FK_5D97E2BC06258A3');
        $this->addSql('DROP TABLE tentative_fraude');
    }
}
