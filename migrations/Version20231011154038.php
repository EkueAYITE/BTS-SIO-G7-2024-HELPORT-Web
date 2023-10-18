<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231011154038 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence_soutien (competence_id INT NOT NULL, soutien_id INT NOT NULL, INDEX IDX_8DEF6C0B15761DAB (competence_id), INDEX IDX_8DEF6C0BBD6949E9 (soutien_id), PRIMARY KEY(competence_id, soutien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_user (competence_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CA0BDC5215761DAB (competence_id), INDEX IDX_CA0BDC52A76ED395 (user_id), PRIMARY KEY(competence_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0BBD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC5215761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC52A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence ADD id_matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F51E6528F FOREIGN KEY (id_matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_94D4687F51E6528F ON competence (id_matiere_id)');
        $this->addSql('ALTER TABLE demande ADD soutien_id INT DEFAULT NULL, ADD id_matiere_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5BD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A551E6528F FOREIGN KEY (id_matiere_id) REFERENCES matiere (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5BD6949E9 ON demande (soutien_id)');
        $this->addSql('CREATE INDEX IDX_2694D7A551E6528F ON demande (id_matiere_id)');
        $this->addSql('ALTER TABLE soutien ADD id_salle_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3218CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_99A7D3218CEBACA0 ON soutien (id_salle_id)');
        $this->addSql('ALTER TABLE user ADD demande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64980E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
        $this->addSql('CREATE INDEX IDX_8D93D64980E95E18 ON user (demande_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0B15761DAB');
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0BBD6949E9');
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC5215761DAB');
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC52A76ED395');
        $this->addSql('DROP TABLE competence_soutien');
        $this->addSql('DROP TABLE competence_user');
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F51E6528F');
        $this->addSql('DROP INDEX IDX_94D4687F51E6528F ON competence');
        $this->addSql('ALTER TABLE competence DROP id_matiere_id');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5BD6949E9');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A551E6528F');
        $this->addSql('DROP INDEX IDX_2694D7A5BD6949E9 ON demande');
        $this->addSql('DROP INDEX IDX_2694D7A551E6528F ON demande');
        $this->addSql('ALTER TABLE demande DROP soutien_id, DROP id_matiere_id');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3218CEBACA0');
        $this->addSql('DROP INDEX IDX_99A7D3218CEBACA0 ON soutien');
        $this->addSql('ALTER TABLE soutien DROP id_salle_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64980E95E18');
        $this->addSql('DROP INDEX IDX_8D93D64980E95E18 ON user');
        $this->addSql('ALTER TABLE user DROP demande_id');
    }
}
