<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322030640 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0B15761DAB');
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0BBD6949E9');
        $this->addSql('DROP TABLE competence_soutien');
        $this->addSql('ALTER TABLE soutien ADD demande_id INT NOT NULL');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D32180E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_99A7D32180E95E18 ON soutien (demande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence_soutien (competence_id INT NOT NULL, soutien_id INT NOT NULL, INDEX IDX_8DEF6C0B15761DAB (competence_id), INDEX IDX_8DEF6C0BBD6949E9 (soutien_id), PRIMARY KEY(competence_id, soutien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0BBD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D32180E95E18');
        $this->addSql('DROP INDEX UNIQ_99A7D32180E95E18 ON soutien');
        $this->addSql('ALTER TABLE soutien DROP demande_id');
    }
}
