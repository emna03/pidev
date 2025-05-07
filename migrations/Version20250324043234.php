<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250324043234 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE declaration_revenus (id INT AUTO_INCREMENT NOT NULL, dossier_id INT DEFAULT NULL, user_id INT NOT NULL, montant_revenu DOUBLE PRECISION NOT NULL, source_revenu VARCHAR(255) NOT NULL, date_declaration VARCHAR(255) NOT NULL, preuve_revenu VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_7257BFC6611C0C56 (dossier_id), INDEX IDX_7257BFC6A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dossier_fiscale (id INT AUTO_INCREMENT NOT NULL, id_declaration_id INT NOT NULL, user_id INT NOT NULL, annee_fiscale VARCHAR(255) NOT NULL, total_impot DOUBLE PRECISION NOT NULL, total_impot_paye DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, date_creation VARCHAR(255) NOT NULL, moyen_payement VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_32CFC392FD04E5A5 (id_declaration_id), INDEX IDX_32CFC392A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier_fiscale (id)');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392FD04E5A5 FOREIGN KEY (id_declaration_id) REFERENCES declaration_revenus (id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6611C0C56');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6A76ED395');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392FD04E5A5');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392A76ED395');
        $this->addSql('DROP TABLE declaration_revenus');
        $this->addSql('DROP TABLE dossier_fiscale');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
