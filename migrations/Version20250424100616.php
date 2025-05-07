<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250424100616 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login_attempt ADD utilisateur_id INT DEFAULT NULL, ADD attempted_at DATETIME NOT NULL, DROP email, DROP attempt_time, CHANGE ip_address ip_address VARCHAR(255) NOT NULL, CHANGE user_agent user_agent VARCHAR(512) NOT NULL');
        $this->addSql('ALTER TABLE login_attempt ADD CONSTRAINT FK_8C11C1BFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_8C11C1BFB88E14F ON login_attempt (utilisateur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE login_attempt DROP FOREIGN KEY FK_8C11C1BFB88E14F');
        $this->addSql('DROP INDEX IDX_8C11C1BFB88E14F ON login_attempt');
        $this->addSql('ALTER TABLE login_attempt ADD email VARCHAR(180) NOT NULL, ADD attempt_time DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP utilisateur_id, DROP attempted_at, CHANGE ip_address ip_address VARCHAR(100) NOT NULL, CHANGE user_agent user_agent VARCHAR(255) NOT NULL');
    }
}
