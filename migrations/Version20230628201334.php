<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628201334 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fiche_technique (id INT AUTO_INCREMENT NOT NULL, modele_id INT DEFAULT NULL, screen_size VARCHAR(255) DEFAULT NULL, processeur VARCHAR(255) DEFAULT NULL, batterie VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, poids VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_505525A9AC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fiche_technique ADD CONSTRAINT FK_505525A9AC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fiche_technique DROP FOREIGN KEY FK_505525A9AC14B70A');
        $this->addSql('DROP TABLE fiche_technique');
    }
}
