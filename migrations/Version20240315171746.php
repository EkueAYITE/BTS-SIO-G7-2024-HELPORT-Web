<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240315171746 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande DROP FOREIGN KEY FK_2694D7A5BD6949E9');
        $this->addSql('DROP INDEX IDX_2694D7A5BD6949E9 ON demande');
        $this->addSql('ALTER TABLE demande DROP soutien_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE demande ADD soutien_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE demande ADD CONSTRAINT FK_2694D7A5BD6949E9 FOREIGN KEY (soutien_id) REFERENCES soutien (id)');
        $this->addSql('CREATE INDEX IDX_2694D7A5BD6949E9 ON demande (soutien_id)');
    }
}
