<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250331231414 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE assistantdocumentaire (id INT NOT NULL, id_utilisateur INT DEFAULT NULL, id_document INT DEFAULT NULL, type_assistance VARCHAR(255) NOT NULL, date_demande VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, remarque LONGTEXT NOT NULL, rappel_automatique TINYINT(1) NOT NULL, INDEX IDX_C366EB3250EAE44 (id_utilisateur), INDEX IDX_C366EB3288B266E3 (id_document), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE declarationrevenus (id INT NOT NULL, id_dossier INT DEFAULT NULL, montant_revenu DOUBLE PRECISION NOT NULL, source_revenu VARCHAR(255) NOT NULL, date_declaration VARCHAR(255) NOT NULL, preuve_revenu VARCHAR(255) NOT NULL, INDEX IDX_C6E7CD81E3D54947 (id_dossier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE documentadministratif (id INT NOT NULL, nom_document VARCHAR(255) NOT NULL, chemin_fichier VARCHAR(255) NOT NULL, date_emission VARCHAR(255) NOT NULL, status VARCHAR(255) NOT NULL, remarque VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE dossierfiscale (id INT NOT NULL, id_user INT DEFAULT NULL, annee_fiscale INT NOT NULL, total_impot DOUBLE PRECISION NOT NULL, total_impot_paye DOUBLE PRECISION NOT NULL, status VARCHAR(255) NOT NULL, date_creation VARCHAR(255) NOT NULL, moyen_paiement VARCHAR(255) NOT NULL, INDEX IDX_61D799006B3CA4B (id_user), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE incident (id INT NOT NULL, service_affecte INT DEFAULT NULL, type_incident VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, localisation VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, date_signalement DATETIME NOT NULL, latitude DOUBLE PRECISION NOT NULL, longitude DOUBLE PRECISION NOT NULL, INDEX IDX_3D03A11A8714FF74 (service_affecte), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE serviceintervention (id INT NOT NULL, nom_service VARCHAR(255) NOT NULL, type_intervention VARCHAR(255) NOT NULL, zone_intervention VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE utilisateur (id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, date_inscription DATE NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', available_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', delivered_at DATETIME DEFAULT NULL COMMENT '(DC2Type:datetime_immutable)', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3250EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3288B266E3 FOREIGN KEY (id_document) REFERENCES documentadministratif (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE declarationrevenus ADD CONSTRAINT FK_C6E7CD81E3D54947 FOREIGN KEY (id_dossier) REFERENCES dossierfiscale (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossierfiscale ADD CONSTRAINT FK_61D799006B3CA4B FOREIGN KEY (id_user) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A8714FF74 FOREIGN KEY (service_affecte) REFERENCES serviceintervention (id) ON DELETE CASCADE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire DROP FOREIGN KEY FK_C366EB3250EAE44
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire DROP FOREIGN KEY FK_C366EB3288B266E3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE declarationrevenus DROP FOREIGN KEY FK_C6E7CD81E3D54947
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE dossierfiscale DROP FOREIGN KEY FK_61D799006B3CA4B
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A8714FF74
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE assistantdocumentaire
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE declarationrevenus
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE documentadministratif
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE dossierfiscale
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE incident
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE serviceintervention
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE utilisateur
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE messenger_messages
        SQL);
    }
}
