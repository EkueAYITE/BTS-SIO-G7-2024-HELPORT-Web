<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240322030750 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE soutien_competence (soutien_id INT NOT NULL, competence_id INT NOT NULL, INDEX IDX_B4A1BCA5BD6949E9 (soutien_id), INDEX IDX_B4A1BCA515761DAB (competence_id), PRIMARY KEY(soutien_id, competence_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE soutien_competence ADD CONSTRAINT FK_B4A1BCA5BD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE soutien_competence ADD CONSTRAINT FK_B4A1BCA515761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE soutien_competence DROP FOREIGN KEY FK_B4A1BCA5BD6949E9');
        $this->addSql('ALTER TABLE soutien_competence DROP FOREIGN KEY FK_B4A1BCA515761DAB');
        $this->addSql('DROP TABLE soutien_competence');
    }
}
