<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302184043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F38C751C4');
        $this->addSql('DROP INDEX IDX_A60C9F1F38C751C4 ON livraison');
        $this->addSql('ALTER TABLE livraison ADD livreur_id INT NOT NULL, ADD sent TINYINT(1) DEFAULT NULL, CHANGE roles_id nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FF8646701 FOREIGN KEY (livreur_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1FC8121CE9 ON livraison (nom_id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1FF8646701 ON livraison (livreur_id)');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E38C751C4');
        $this->addSql('DROP INDEX IDX_66AB212E38C751C4 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE roles_id nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EC8121CE9 ON transport (nom_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL, CHANGE available_at available_at DATETIME NOT NULL, CHANGE delivered_at delivered_at DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87F347EFB');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E8782EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FC8121CE9');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FF8646701');
        $this->addSql('DROP INDEX IDX_A60C9F1FC8121CE9 ON livraison');
        $this->addSql('DROP INDEX IDX_A60C9F1FF8646701 ON livraison');
        $this->addSql('ALTER TABLE livraison DROP livreur_id, DROP sent, CHANGE nom_id roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F38C751C4 FOREIGN KEY (roles_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F38C751C4 ON livraison (roles_id)');
        $this->addSql('ALTER TABLE messenger_messages CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE available_at available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE delivered_at delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC8121CE9');
        $this->addSql('DROP INDEX IDX_66AB212EC8121CE9 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE nom_id roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E38C751C4 FOREIGN KEY (roles_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E38C751C4 ON transport (roles_id)');
    }
}
