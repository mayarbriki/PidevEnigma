<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240218174206 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, date_creation DATE NOT NULL, status VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, reference VARCHAR(255) NOT NULL, INDEX IDX_6EEAA67DFB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commande_produit (id INT AUTO_INCREMENT NOT NULL, produit_id INT DEFAULT NULL, commande_id INT DEFAULT NULL, quantite_produit INT NOT NULL, INDEX IDX_DF1E9E87F347EFB (produit_id), INDEX IDX_DF1E9E8782EA2E54 (commande_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, idmoyentransport_id INT DEFAULT NULL, id_livreur_id INT DEFAULT NULL, id_article_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_A60C9F1F3BCD3240 (idmoyentransport_id), UNIQUE INDEX UNIQ_A60C9F1F5DEEE7D6 (id_livreur_id), UNIQUE INDEX UNIQ_A60C9F1FD71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier (id INT AUTO_INCREMENT NOT NULL, utilisateur_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_24CC0DF2FB88E14F (utilisateur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE panier_produit (panier_id INT NOT NULL, produit_id INT NOT NULL, INDEX IDX_D31F28A6F77D927C (panier_id), INDEX IDX_D31F28A6F347EFB (produit_id), PRIMARY KEY(panier_id, produit_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produit (id INT AUTO_INCREMENT NOT NULL, categorys_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, prix DOUBLE PRECISION NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_29A5EC27A96778EC (categorys_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, date_r DATE DEFAULT NULL, description_r VARCHAR(255) DEFAULT NULL, status_r VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, idrec_id INT DEFAULT NULL, reponse VARCHAR(255) DEFAULT NULL, INDEX IDX_5FB6DEC772D41C37 (idrec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, nom_produit VARCHAR(255) DEFAULT NULL, quantite_entre INT DEFAULT NULL, quantite_sortie INT DEFAULT NULL, quantite_restante INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_4B365660670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, nom_user VARCHAR(255) DEFAULT NULL, prenom_user VARCHAR(255) DEFAULT NULL, email_user VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E87F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE commande_produit ADD CONSTRAINT FK_DF1E9E8782EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3BCD3240 FOREIGN KEY (idmoyentransport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F5DEEE7D6 FOREIGN KEY (id_livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE panier ADD CONSTRAINT FK_24CC0DF2FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE panier_produit ADD CONSTRAINT FK_D31F28A6F77D927C FOREIGN KEY (panier_id) REFERENCES panier (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE panier_produit ADD CONSTRAINT FK_D31F28A6F347EFB FOREIGN KEY (produit_id) REFERENCES produit (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produit ADD CONSTRAINT FK_29A5EC27A96778EC FOREIGN KEY (categorys_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC772D41C37 FOREIGN KEY (idrec_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67DFB88E14F');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E87F347EFB');
        $this->addSql('ALTER TABLE commande_produit DROP FOREIGN KEY FK_DF1E9E8782EA2E54');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3BCD3240');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F5DEEE7D6');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FD71E064B');
        $this->addSql('ALTER TABLE panier DROP FOREIGN KEY FK_24CC0DF2FB88E14F');
        $this->addSql('ALTER TABLE panier_produit DROP FOREIGN KEY FK_D31F28A6F77D927C');
        $this->addSql('ALTER TABLE panier_produit DROP FOREIGN KEY FK_D31F28A6F347EFB');
        $this->addSql('ALTER TABLE produit DROP FOREIGN KEY FK_29A5EC27A96778EC');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC772D41C37');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660670C757F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE commande');
        $this->addSql('DROP TABLE commande_produit');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE panier');
        $this->addSql('DROP TABLE panier_produit');
        $this->addSql('DROP TABLE produit');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
