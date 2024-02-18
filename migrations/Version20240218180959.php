<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218180959 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F5DEEE7D6');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FD71E064B');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3BCD3240');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F3BCD3240 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1F5DEEE7D6 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1FD71E064B ON livraison');
        $this->addSql('ALTER TABLE livraison ADD type_id INT DEFAULT NULL, ADD artlib_id INT DEFAULT NULL, ADD nom_id INT DEFAULT NULL, DROP idmoyentransport_id, DROP id_livreur_id, DROP id_article_id');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FC54C8C93 FOREIGN KEY (type_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FB8781A2B FOREIGN KEY (artlib_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1FC54C8C93 ON livraison (type_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1FB8781A2B ON livraison (artlib_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1FC8121CE9 ON livraison (nom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FC54C8C93');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FB8781A2B');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FC8121CE9');
        $this->addSql('DROP INDEX UNIQ_A60C9F1FC54C8C93 ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1FB8781A2B ON livraison');
        $this->addSql('DROP INDEX UNIQ_A60C9F1FC8121CE9 ON livraison');
        $this->addSql('ALTER TABLE livraison ADD idmoyentransport_id INT DEFAULT NULL, ADD id_livreur_id INT DEFAULT NULL, ADD id_article_id INT DEFAULT NULL, DROP type_id, DROP artlib_id, DROP nom_id');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F5DEEE7D6 FOREIGN KEY (id_livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3BCD3240 FOREIGN KEY (idmoyentransport_id) REFERENCES transport (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F3BCD3240 ON livraison (idmoyentransport_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1F5DEEE7D6 ON livraison (id_livreur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_A60C9F1FD71E064B ON livraison (id_article_id)');
    }
}
