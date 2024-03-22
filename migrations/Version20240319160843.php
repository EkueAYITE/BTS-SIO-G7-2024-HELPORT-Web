<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240319160843 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE competence (id INT AUTO_INCREMENT NOT NULL, id_matiere_id INT DEFAULT NULL, statut INT NOT NULL, INDEX IDX_94D4687F51E6528F (id_matiere_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_soutien (competence_id INT NOT NULL, soutien_id INT NOT NULL, INDEX IDX_8DEF6C0B15761DAB (competence_id), INDEX IDX_8DEF6C0BBD6949E9 (soutien_id), PRIMARY KEY(competence_id, soutien_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE competence_user (competence_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_CA0BDC5215761DAB (competence_id), INDEX IDX_CA0BDC52A76ED395 (user_id), PRIMARY KEY(competence_id, user_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, id_matiere_id INT DEFAULT NULL, user_id INT NOT NULL, date_uptaded DATE NOT NULL, date_fin_demande DATE NOT NULL, statut VARCHAR(255) NOT NULL, sous_matiere VARCHAR(255) NOT NULL, INDEX IDX_2694D7A551E6528F (id_matiere_id), INDEX IDX_2694D7A5A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE matiere (id INT AUTO_INCREMENT NOT NULL, designation VARCHAR(200) NOT NULL, code INT NOT NULL, sous_matiere LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE salle (id INT AUTO_INCREMENT NOT NULL, code_salle VARCHAR(10) NOT NULL, etage INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE soutien (id INT AUTO_INCREMENT NOT NULL, id_salle_id INT DEFAULT NULL, date_du_soutien DATE NOT NULL, date_update DATE NOT NULL, description LONGTEXT NOT NULL, statut INT NOT NULL, INDEX IDX_99A7D3218CEBACA0 (id_salle_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, demande_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, sexe INT NOT NULL, telephone VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D64980E95E18 (demande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE competence ADD CONSTRAINT FK_94D4687F51E6528F FOREIGN KEY (id_matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0B15761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_soutien ADD CONSTRAINT FK_8DEF6C0BBD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC5215761DAB FOREIGN KEY (competence_id) REFERENCES competence (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE competence_user ADD CONSTRAINT FK_CA0BDC52A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A551E6528F FOREIGN KEY (id_matiere_id) REFERENCES matiere (id)');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE soutien ADD CONSTRAINT FK_99A7D3218CEBACA0 FOREIGN KEY (id_salle_id) REFERENCES salle (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D64980E95E18 FOREIGN KEY (demande_id) REFERENCES demande (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE competence DROP FOREIGN KEY FK_94D4687F51E6528F');
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0B15761DAB');
        $this->addSql('ALTER TABLE competence_soutien DROP FOREIGN KEY FK_8DEF6C0BBD6949E9');
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC5215761DAB');
        $this->addSql('ALTER TABLE competence_user DROP FOREIGN KEY FK_CA0BDC52A76ED395');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A551E6528F');
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5A76ED395');
        $this->addSql('ALTER TABLE soutien DROP FOREIGN KEY FK_99A7D3218CEBACA0');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D64980E95E18');
        $this->addSql('DROP TABLE competence');
        $this->addSql('DROP TABLE competence_soutien');
        $this->addSql('DROP TABLE competence_user');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE matiere');
        $this->addSql('DROP TABLE salle');
        $this->addSql('DROP TABLE soutien');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
