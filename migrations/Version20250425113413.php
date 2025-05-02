<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250425113413 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration_revenus DROP INDEX dossier_id, ADD UNIQUE INDEX UNIQ_7257BFC6611C0C56 (dossier_id)');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY dossier_id');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY user_id');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY user_id');
        $this->addSql('ALTER TABLE declaration_revenus CHANGE is_suspected is_suspected INT NOT NULL');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier_fiscale (id)');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('DROP INDEX user_id ON declaration_revenus');
        $this->addSql('CREATE INDEX IDX_7257BFC6A76ED395 ON declaration_revenus (user_id)');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_fiscale DROP INDEX declaration_id, ADD UNIQUE INDEX UNIQ_32CFC392C06258A3 (declaration_id)');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_2');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_1');
        $this->addSql('DROP INDEX token ON dossier_fiscale');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY dossier_fiscale_ibfk_1');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392C06258A3 FOREIGN KEY (declaration_id) REFERENCES declaration_revenus (id)');
        $this->addSql('DROP INDEX user_id ON dossier_fiscale');
        $this->addSql('CREATE INDEX IDX_32CFC392A76ED395 ON dossier_fiscale (user_id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE incident CHANGE description description LONGTEXT NOT NULL, CHANGE statut statut VARCHAR(255) DEFAULT \'En attente\' NOT NULL, CHANGE date_signalement date_signalement DATETIME NOT NULL, CHANGE danger_level danger_level VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A8714FF74 FOREIGN KEY (service_affecte) REFERENCES serviceintervention (id)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11AFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_3D03A11AFB88E14F ON incident (utilisateur_id)');
        $this->addSql('DROP INDEX fk_incident_service ON incident');
        $this->addSql('CREATE INDEX IDX_3D03A11A8714FF74 ON incident (service_affecte)');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE role role VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE declaration_revenus DROP INDEX UNIQ_7257BFC6611C0C56, ADD INDEX dossier_id (dossier_id)');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6611C0C56');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6A76ED395');
        $this->addSql('ALTER TABLE declaration_revenus DROP FOREIGN KEY FK_7257BFC6A76ED395');
        $this->addSql('ALTER TABLE declaration_revenus CHANGE is_suspected is_suspected INT DEFAULT NULL');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT dossier_id FOREIGN KEY (dossier_id) REFERENCES dossier_fiscale (id) ON UPDATE CASCADE ON DELETE SET NULL');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT user_id FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('DROP INDEX idx_7257bfc6a76ed395 ON declaration_revenus');
        $this->addSql('CREATE INDEX user_id ON declaration_revenus (user_id)');
        $this->addSql('ALTER TABLE declaration_revenus ADD CONSTRAINT FK_7257BFC6A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE dossier_fiscale DROP INDEX UNIQ_32CFC392C06258A3, ADD INDEX declaration_id (declaration_id)');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392A76ED395');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392C06258A3');
        $this->addSql('ALTER TABLE dossier_fiscale DROP FOREIGN KEY FK_32CFC392A76ED395');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_2 FOREIGN KEY (declaration_id) REFERENCES declaration_revenus (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT dossier_fiscale_ibfk_1 FOREIGN KEY (user_id) REFERENCES utilisateur (id) ON UPDATE CASCADE ON DELETE CASCADE');
        $this->addSql('CREATE UNIQUE INDEX token ON dossier_fiscale (token)');
        $this->addSql('DROP INDEX idx_32cfc392a76ed395 ON dossier_fiscale');
        $this->addSql('CREATE INDEX user_id ON dossier_fiscale (user_id)');
        $this->addSql('ALTER TABLE dossier_fiscale ADD CONSTRAINT FK_32CFC392A76ED395 FOREIGN KEY (user_id) REFERENCES utilisateur (id)');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A8714FF74');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11AFB88E14F');
        $this->addSql('DROP INDEX IDX_3D03A11AFB88E14F ON incident');
        $this->addSql('ALTER TABLE incident DROP FOREIGN KEY FK_3D03A11A8714FF74');
        $this->addSql('ALTER TABLE incident CHANGE description description TEXT NOT NULL, CHANGE statut statut VARCHAR(255) DEFAULT NULL, CHANGE date_signalement date_signalement DATETIME DEFAULT CURRENT_TIMESTAMP, CHANGE danger_level danger_level VARCHAR(255) DEFAULT \'0\' NOT NULL');
        $this->addSql('DROP INDEX idx_3d03a11a8714ff74 ON incident');
        $this->addSql('CREATE INDEX fk_incident_service ON incident (service_affecte)');
        $this->addSql('ALTER TABLE incident ADD CONSTRAINT FK_3D03A11A8714FF74 FOREIGN KEY (service_affecte) REFERENCES serviceintervention (id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE role role VARCHAR(255) DEFAULT NULL');
    }
}
