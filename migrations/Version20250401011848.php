<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250401011848 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire DROP FOREIGN KEY FK_C366EB3288B266E3
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire DROP FOREIGN KEY FK_C366EB3250EAE44
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire CHANGE date_demande date_demande DATETIME NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3288B266E3 FOREIGN KEY (id_document) REFERENCES documentadministratif (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3250EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id)
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
            ALTER TABLE assistantdocumentaire CHANGE date_demande date_demande VARCHAR(255) NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3250EAE44 FOREIGN KEY (id_utilisateur) REFERENCES utilisateur (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE assistantdocumentaire ADD CONSTRAINT FK_C366EB3288B266E3 FOREIGN KEY (id_document) REFERENCES documentadministratif (id) ON DELETE CASCADE
        SQL);
    }
}
