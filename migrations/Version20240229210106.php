<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240229210106 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE commande_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite_produit INT NOT NULL, INDEX IDX_DF1E9E87F347EFB (produit_id), INDEX IDX_DF1E9E8782EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livreur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, numero_tel INT DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, histoire_liv VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL, available_at DATETIME NOT NULL, delivered_at DATETIME DEFAULT NULL, INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F38C751C4');
        $this->addSql('DROP INDEX IDX_A60C9F1F38C751C4 ON livraison');
        $this->addSql('ALTER TABLE livraison CHANGE roles_id nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1FC8121CE9 ON livraison (nom_id)');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212E38C751C4');
        $this->addSql('DROP INDEX IDX_66AB212E38C751C4 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE roles_id nom_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212EC8121CE9 FOREIGN KEY (nom_id) REFERENCES livreur (id)');
        $this->addSql('CREATE INDEX IDX_66AB212EC8121CE9 ON transport (nom_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FC8121CE9');
        $this->addSql('ALTER TABLE transport DROP FOREIGN KEY FK_66AB212EC8121CE9');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87F347EFB');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E8782EA2E54');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE livreur');
        $this->addSql('DROP TABLE messenger_messages');
        $this->addSql('DROP INDEX IDX_A60C9F1FC8121CE9 ON livraison');
        $this->addSql('ALTER TABLE livraison CHANGE nom_id roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F38C751C4 FOREIGN KEY (roles_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_A60C9F1F38C751C4 ON livraison (roles_id)');
        $this->addSql('DROP INDEX IDX_66AB212EC8121CE9 ON transport');
        $this->addSql('ALTER TABLE transport CHANGE nom_id roles_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE transport ADD CONSTRAINT FK_66AB212E38C751C4 FOREIGN KEY (roles_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_66AB212E38C751C4 ON transport (roles_id)');
    }
}
