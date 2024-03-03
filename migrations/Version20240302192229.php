<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302192229 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE article (id INT AUTO_INCREMENT NOT NULL, id_cat_id INT DEFAULT NULL, artlib VARCHAR(255) DEFAULT NULL, artdesc VARCHAR(255) DEFAULT NULL, artdispo INT DEFAULT NULL, artimg VARCHAR(255) DEFAULT NULL, artprix DOUBLE PRECISION DEFAULT NULL, INDEX IDX_23A0E66C09A1CAE (id_cat_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categorie (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, telephone INT DEFAULT NULL, ville VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraison (id INT AUTO_INCREMENT NOT NULL, idmoyentransport_id INT DEFAULT NULL, id_livreur_id INT DEFAULT NULL, id_article_id INT DEFAULT NULL, UNIQUE INDEX UNIQ_A60C9F1F3BCD3240 (idmoyentransport_id), UNIQUE INDEX UNIQ_A60C9F1F5DEEE7D6 (id_livreur_id), UNIQUE INDEX UNIQ_A60C9F1FD71E064B (id_article_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reclamation (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) DEFAULT NULL, date_r DATE DEFAULT NULL, description_r VARCHAR(255) DEFAULT NULL, status_r VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reponse (id INT AUTO_INCREMENT NOT NULL, idrec_id INT DEFAULT NULL, reponse VARCHAR(255) DEFAULT NULL, INDEX IDX_5FB6DEC772D41C37 (idrec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stock (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, nom_produit VARCHAR(255) DEFAULT NULL, quantite_entre INT DEFAULT NULL, quantite_sortie INT DEFAULT NULL, quantite_restante INT DEFAULT NULL, date DATE DEFAULT NULL, INDEX IDX_4B365660670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transport (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) DEFAULT NULL, status VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) DEFAULT NULL, prenom VARCHAR(255) DEFAULT NULL, ville VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateurs (id INT AUTO_INCREMENT NOT NULL, id_user INT DEFAULT NULL, nom_user VARCHAR(255) DEFAULT NULL, prenom_user VARCHAR(255) DEFAULT NULL, email_user VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE article ADD CONSTRAINT FK_23A0E66C09A1CAE FOREIGN KEY (id_cat_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F3BCD3240 FOREIGN KEY (idmoyentransport_id) REFERENCES transport (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1F5DEEE7D6 FOREIGN KEY (id_livreur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE livraison ADD CONSTRAINT FK_A60C9F1FD71E064B FOREIGN KEY (id_article_id) REFERENCES article (id)');
        $this->addSql('ALTER TABLE reponse ADD CONSTRAINT FK_5FB6DEC772D41C37 FOREIGN KEY (idrec_id) REFERENCES reclamation (id)');
        $this->addSql('ALTER TABLE stock ADD CONSTRAINT FK_4B365660670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE article DROP FOREIGN KEY FK_23A0E66C09A1CAE');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F3BCD3240');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1F5DEEE7D6');
        $this->addSql('ALTER TABLE livraison DROP FOREIGN KEY FK_A60C9F1FD71E064B');
        $this->addSql('ALTER TABLE reponse DROP FOREIGN KEY FK_5FB6DEC772D41C37');
        $this->addSql('ALTER TABLE stock DROP FOREIGN KEY FK_4B365660670C757F');
        $this->addSql('DROP TABLE article');
        $this->addSql('DROP TABLE categorie');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE livraison');
        $this->addSql('DROP TABLE reclamation');
        $this->addSql('DROP TABLE reponse');
        $this->addSql('DROP TABLE stock');
        $this->addSql('DROP TABLE transport');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE utilisateurs');
    }
}
