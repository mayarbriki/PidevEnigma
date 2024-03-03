<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240303192539 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, reference_id INT DEFAULT NULL, matricule_id INT DEFAULT NULL, nom_id INT DEFAULT NULL, livreur_id INT NOT NULL, date_liv DATE DEFAULT NULL, adresse_liv VARCHAR(255) DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, sent TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_A60C9F1F1645DEA9 (reference_id), UNIQUE INDEX UNIQ_A60C9F1F9AAADC05 (matricule_id), INDEX IDX_A60C9F1FC8121CE9 (nom_id), INDEX IDX_A60C9F1FF8646701 (livreur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F1645DEA9 FOREIGN KEY (reference_id) REFERENCES commande (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F9AAADC05 FOREIGN KEY (matricule_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE produit ADD rate INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E38C751C4');
        $this->addSql('DROP INDEX IDX_66AB212E38C751C4 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE roles_id nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EC8121CE9 ON transport (nom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F1645DEA9');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F9AAADC05');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FC8121CE9');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FF8646701');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('ALTER TABLE produit DROP rate');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC8121CE9');
        $this->addSql('DROP INDEX IDX_66AB212EC8121CE9 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE nom_id roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E38C751C4 FOREIGN KEY (roles_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E38C751C4 ON transport (roles_id)');
    }
}
