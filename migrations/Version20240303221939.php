<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303221939 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC8121CE9');
        $this->addSql('DROP INDEX IDX_66AB212EC8121CE9 ON transport');
        $this->addSql('ALTER TABLE transport ADD livreur_id INT NOT NULL, DROP nom_id');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EF8646701 FOREIGN KEY (livreur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EF8646701 ON transport (livreur_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EF8646701');
        $this->addSql('DROP INDEX IDX_66AB212EF8646701 ON transport');
        $this->addSql('ALTER TABLE transport ADD nom_id INT DEFAULT NULL, DROP livreur_id');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EC8121CE9 ON transport (nom_id)');
    }
}
