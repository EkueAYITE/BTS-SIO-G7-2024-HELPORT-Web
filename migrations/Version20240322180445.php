<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322180445 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D32180E95E18');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3218CEBACA0');
        $this->addSql('ALTER TABLE soutien_competence DROP FOREIGN KEY FK_B4A1BCA5BD6949E9');
        $this->addSql('ALTER TABLE soutien_competence DROP FOREIGN KEY FK_B4A1BCA515761DAB');
        $this->addSql('DROP TABLE soutien');
        $this->addSql('DROP TABLE soutien_competence');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soutien (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT DEFAULT NULL, demande_id INT NOT NULL, date_du_soutien DATE NOT NULL, date_update DATE NOT NULL, description LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, statut INT NOT NULL, UNIQUE INDEX UNIQ_99A7D32180E95E18 (demande_id), INDEX IDX_99A7D3218CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE soutien_competence (soutien_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_B4A1BCA515761DAB (competence_id), INDEX IDX_B4A1BCA5BD6949E9 (soutien_id), PRIMARY KEY(soutien_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D32180E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3218CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE soutien_competence ADD CONSTRAINT FK_B4A1BCA5BD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE soutien_competence ADD CONSTRAINT FK_B4A1BCA515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }
}
