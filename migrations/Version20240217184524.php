<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240217184524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison ADD id_livreur_id INT DEFAULT NULL, ADD id_article_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F5DEEE7D6 FOREIGN KEY (id_livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F5DEEE7D6 ON livraison (id_livreur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1FD71E064B ON livraison (id_article_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F5DEEE7D6');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FD71E064B');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F5DEEE7D6 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1FD71E064B ON livraison');
        $this->addSql('ALTER TABLE livraison DROP id_livreur_id, DROP id_article_id');
    }
}
