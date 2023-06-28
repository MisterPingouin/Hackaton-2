<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628123800 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE phone (id INT AUTO_INCREMENT NOT NULL, marque_id INT NOT NULL, modele_id INT NOT NULL, ram VARCHAR(255) NOT NULL, stockage VARCHAR(255) NOT NULL, INDEX IDX_444F97DD4827B9B2 (marque_id), INDEX IDX_444F97DDAC14B70A (modele_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DD4827B9B2 FOREIGN KEY (marque_id) REFERENCES marque (id)');
        $this->addSql('ALTER TABLE phone ADD CONSTRAINT FK_444F97DDAC14B70A FOREIGN KEY (modele_id) REFERENCES modele (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DD4827B9B2');
        $this->addSql('ALTER TABLE phone DROP FOREIGN KEY FK_444F97DDAC14B70A');
        $this->addSql('DROP TABLE phone');
    }
}
