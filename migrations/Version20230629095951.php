<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230629095951 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE discussion DROP FOREIGN KEY FK_C0B9F90FF675F31B');
        $this->addSql('ALTER TABLE discussion_category DROP FOREIGN KEY FK_B31488D612469DE2');
        $this->addSql('ALTER TABLE discussion_category DROP FOREIGN KEY FK_B31488D61ADED311');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE discussion');
        $this->addSql('DROP TABLE discussion_category');
        $this->addSql('ALTER TABLE phone ADD entry_date DATETIME NOT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', ADD exit_date DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetimetz_immutable)\', CHANGE marque_id marque_id INT DEFAULT NULL, CHANGE modele_id modele_id INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE discussion (id INT AUTO_INCREMENT NOT NULL, author_id INT NOT NULL, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, content LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_C0B9F90FF675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE discussion_category (discussion_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_B31488D612469DE2 (category_id), INDEX IDX_B31488D61ADED311 (discussion_id), PRIMARY KEY(discussion_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE discussion ADD CONSTRAINT FK_C0B9F90FF675F31B FOREIGN KEY (author_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE discussion_category ADD CONSTRAINT FK_B31488D612469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE discussion_category ADD CONSTRAINT FK_B31488D61ADED311 FOREIGN KEY (discussion_id) REFERENCES discussion (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE phone DROP entry_date, DROP exit_date, CHANGE marque_id marque_id INT NOT NULL, CHANGE modele_id modele_id INT NOT NULL');
    }
}
