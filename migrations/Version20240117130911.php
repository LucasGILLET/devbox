<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240117130911 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressouce DROP FOREIGN KEY FK_236A2FEBB6C48410');
        $this->addSql('DROP INDEX IDX_236A2FEBB6C48410 ON ressouce');
        $this->addSql('ALTER TABLE ressouce CHANGE dossier_id_id dossier_id INT NOT NULL');
        $this->addSql('ALTER TABLE ressouce ADD CONSTRAINT FK_236A2FEB611C0C56 FOREIGN KEY (dossier_id) REFERENCES dossier (id)');
        $this->addSql('CREATE INDEX IDX_236A2FEB611C0C56 ON ressouce (dossier_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ressouce DROP FOREIGN KEY FK_236A2FEB611C0C56');
        $this->addSql('DROP INDEX IDX_236A2FEB611C0C56 ON ressouce');
        $this->addSql('ALTER TABLE ressouce CHANGE dossier_id dossier_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE ressouce ADD CONSTRAINT FK_236A2FEBB6C48410 FOREIGN KEY (dossier_id_id) REFERENCES dossier (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_236A2FEBB6C48410 ON ressouce (dossier_id_id)');
    }
}
