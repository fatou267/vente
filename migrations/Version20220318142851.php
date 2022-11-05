<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220318142851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE adresses (id INT AUTO_INCREMENT NOT NULL, ville LONGTEXT NOT NULL, libelle LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(100) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commandes (id INT AUTO_INCREMENT NOT NULL, users_id INT NOT NULL, date DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', prixtotal INT NOT NULL, INDEX IDX_35D4282C67B3B43D (users_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE details (id_commandes_id INT NOT NULL, id_produits_id INT NOT NULL, prix INT NOT NULL, INDEX IDX_72260B8AA834B794 (id_commandes_id), INDEX IDX_72260B8AD5036F38 (id_produits_id), PRIMARY KEY(id_commandes_id, id_produits_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE livraisons (id INT AUTO_INCREMENT NOT NULL, id_commandes_id INT DEFAULT NULL, dateprevu DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', dateliv DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_96A0CE61A834B794 (id_commandes_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits (id INT AUTO_INCREMENT NOT NULL, id_sous_cate_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, quantite INT NOT NULL, prix INT NOT NULL, image LONGTEXT DEFAULT NULL, INDEX IDX_BE2DDF8C7DF805DA (id_sous_cate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sous_categories (id INT AUTO_INCREMENT NOT NULL, id_cate_id INT DEFAULT NULL, nom VARCHAR(100) NOT NULL, INDEX IDX_DC8B1382A3ADA195 (id_cate_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, adresse_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, telephone VARCHAR(10) DEFAULT NULL, taille VARCHAR(2) DEFAULT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E94DE7DC5C (adresse_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE commandes ADD CONSTRAINT FK_35D4282C67B3B43D FOREIGN KEY (users_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AA834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE details ADD CONSTRAINT FK_72260B8AD5036F38 FOREIGN KEY (id_produits_id) REFERENCES produits (id)');
        $this->addSql('ALTER TABLE livraisons ADD CONSTRAINT FK_96A0CE61A834B794 FOREIGN KEY (id_commandes_id) REFERENCES commandes (id)');
        $this->addSql('ALTER TABLE produits ADD CONSTRAINT FK_BE2DDF8C7DF805DA FOREIGN KEY (id_sous_cate_id) REFERENCES sous_categories (id)');
        $this->addSql('ALTER TABLE sous_categories ADD CONSTRAINT FK_DC8B1382A3ADA195 FOREIGN KEY (id_cate_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E94DE7DC5C FOREIGN KEY (adresse_id) REFERENCES adresses (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E94DE7DC5C');
        $this->addSql('ALTER TABLE sous_categories DROP FOREIGN KEY FK_DC8B1382A3ADA195');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AA834B794');
        $this->addSql('ALTER TABLE livraisons DROP FOREIGN KEY FK_96A0CE61A834B794');
        $this->addSql('ALTER TABLE details DROP FOREIGN KEY FK_72260B8AD5036F38');
        $this->addSql('ALTER TABLE produits DROP FOREIGN KEY FK_BE2DDF8C7DF805DA');
        $this->addSql('ALTER TABLE commandes DROP FOREIGN KEY FK_35D4282C67B3B43D');
        $this->addSql('DROP TABLE adresses');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE commandes');
        $this->addSql('DROP TABLE details');
        $this->addSql('DROP TABLE livraisons');
        $this->addSql('DROP TABLE produits');
        $this->addSql('DROP TABLE sous_categories');
        $this->addSql('DROP TABLE users');
    }
}
