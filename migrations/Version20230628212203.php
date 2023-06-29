<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230628212203 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment ADD user_id_id INT NOT NULL, ADD discussion_id_id INT NOT NULL, ADD content LONGTEXT NOT NULL, ADD publication_date DATETIME NOT NULL');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526C9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comment ADD CONSTRAINT FK_9474526CB0DB6562 FOREIGN KEY (discussion_id_id) REFERENCES discussion (id)');
        $this->addSql('CREATE INDEX IDX_9474526C9D86650F ON comment (user_id_id)');
        $this->addSql('CREATE INDEX IDX_9474526CB0DB6562 ON comment (discussion_id_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526C9D86650F');
        $this->addSql('ALTER TABLE comment DROP FOREIGN KEY FK_9474526CB0DB6562');
        $this->addSql('DROP INDEX IDX_9474526C9D86650F ON comment');
        $this->addSql('DROP INDEX IDX_9474526CB0DB6562 ON comment');
        $this->addSql('ALTER TABLE comment DROP user_id_id, DROP discussion_id_id, DROP content, DROP publication_date');
    }
}
