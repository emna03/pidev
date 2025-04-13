<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250407194949 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6611C0C56');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_1');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392FD04E5A5');
        $this->addSql('DROP TABLE declaration_revenus');
        $this->addSql('DROP TABLE dossier_fiscale');
        $this->addSql('DROP INDEX IDX_75EA56E0E3BD61CE ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E016BA31DB ON messenger_messages');
        $this->addSql('DROP INDEX IDX_75EA56E0FB7336F0 ON messenger_messages');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE queue_name queue_name VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur CHANGE visage_hash visage_hash VARCHAR(255) DEFAULT NULL, CHANGE activer activer INT NOT NULL, CHANGE dateInscription date_inscription DATE NOT NULL, CHANGE motDePasse mot_de_passe VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE declaration_revenus (id INT AUTO_INCREMENT NOT NULL, dossier_id INT DEFAULT NULL, user_id INT NOT NULL, montant_revenu DOUBLE PRECISION NOT NULL, source_revenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_declaration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, preuve_revenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_7257BFC6A76ED395 (user_id), UNIQUE INDEX UNIQ_7257BFC6611C0C56 (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dossier_fiscale (id INT AUTO_INCREMENT NOT NULL, id_declaration_id INT NOT NULL, user_id INT NOT NULL, annee_fiscale VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, total_impot DOUBLE PRECISION NOT NULL, total_impot_paye DOUBLE PRECISION NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, moyen_payement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_32CFC392FD04E5A5 (id_declaration_id), INDEX user_id (user_id), UNIQUE INDEX unique_user_year (user_id, annee_fiscale), INDEX IDX_32CFC392A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier_fiscale (id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392FD04E5A5 FOREIGN KEY (id_declaration_id) REFERENCES declaration_revenus (id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE id id BIGINT AUTO_INCREMENT NOT NULL, CHANGE queue_name queue_name VARCHAR(190) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('ALTER TABLE utilisateur CHANGE visage_hash visage_hash VARCHAR(10000) DEFAULT NULL, CHANGE activer activer INT DEFAULT 0 NOT NULL, CHANGE date_inscription dateInscription DATE NOT NULL, CHANGE mot_de_passe motDePasse VARCHAR(255) DEFAULT NULL');
    }
}
