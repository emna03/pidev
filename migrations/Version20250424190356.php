<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424190356 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY dossier_id');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY user_id');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_2');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_1');
        $this->addSql('ALTER TABLE tentative_fraude DROP FOREIGN KEY FK_5D97E2BC06258A3');
        $this->addSql('DROP TABLE declaration_revenus');
        $this->addSql('DROP TABLE dossier_fiscale');
        $this->addSql('DROP TABLE tentative_fraude');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE declaration_revenus (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, dossier_id INT DEFAULT NULL, montant_revenu DOUBLE PRECISION NOT NULL, source_revenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, date_declaration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, preuve_revenu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_general_ci`, is_suspected INT DEFAULT NULL, INDEX user_id (user_id), INDEX dossier_id (dossier_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_general_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE dossier_fiscale (id INT AUTO_INCREMENT NOT NULL, declaration_id INT NOT NULL, user_id INT NOT NULL, annee_fiscale VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, total_impot DOUBLE PRECISION NOT NULL, total_impot_paye DOUBLE PRECISION NOT NULL, status VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, date_creation VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, moyen_payement VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, INDEX declaration_id (declaration_id), INDEX user_id (user_id), UNIQUE INDEX token (token), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE tentative_fraude (id INT AUTO_INCREMENT NOT NULL, declaration_id INT NOT NULL, type_fraude VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_5D97E2BC06258A3 (declaration_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT dossier_id FOREIGN KEY (dossier_id) REFERENCES dossier_fiscale (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_2 FOREIGN KEY (declaration_id) REFERENCES declaration_revenus (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tentative_fraude ADD CONSTRAINT FK_5D97E2BC06258A3 FOREIGN KEY (declaration_id) REFERENCES declaration_revenus (id)');
    }
}
