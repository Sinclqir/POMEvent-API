<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231213145502 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE abonnement (id INT AUTO_INCREMENT NOT NULL, nom_abonnement VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, tarif DOUBLE PRECISION NOT NULL, duree_en_mois INT NOT NULL, avantages LONGTEXT NOT NULL, remises LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE calendrier_prestataires (id INT AUTO_INCREMENT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, numero_telephone VARCHAR(20) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE demande (id INT AUTO_INCREMENT NOT NULL, date_demande DATETIME NOT NULL, preferences VARCHAR(255) DEFAULT NULL, budget DOUBLE PRECISION NOT NULL, documents VARCHAR(255) DEFAULT NULL, description_detaillee LONGTEXT NOT NULL, photos VARCHAR(255) DEFAULT NULL, videos VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE devis (id INT AUTO_INCREMENT NOT NULL, cout DOUBLE PRECISION NOT NULL, services_inclus VARCHAR(255) NOT NULL, statut VARCHAR(50) NOT NULL, date_devis DATETIME NOT NULL, date_validite_devis DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE evenement (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_debut DATETIME NOT NULL, date_fin DATETIME NOT NULL, lieu VARCHAR(255) NOT NULL, description LONGTEXT DEFAULT NULL, type VARCHAR(255) NOT NULL, statut VARCHAR(255) NOT NULL, nbre_participants INT NOT NULL, budget_total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE message (id INT AUTO_INCREMENT NOT NULL, contenu LONGTEXT NOT NULL, date_envoi TINYINT(1) NOT NULL, fichier_joint VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE prestataire (id INT AUTO_INCREMENT NOT NULL, nom_entreprise VARCHAR(255) NOT NULL, nom_prestataire VARCHAR(255) NOT NULL, type_service VARCHAR(255) NOT NULL, competences VARCHAR(255) NOT NULL, portfolio VARCHAR(255) DEFAULT NULL, description LONGTEXT DEFAULT NULL, disponible TINYINT(1) NOT NULL, date_disponibilite DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, date_reservation DATETIME NOT NULL, cout_total DOUBLE PRECISION NOT NULL, statut VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE utilisateur (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL, type_utilisateur VARCHAR(50) NOT NULL, date_naissance DATETIME NOT NULL, photo_profil VARCHAR(255) DEFAULT NULL, langues_parlees VARCHAR(255) DEFAULT NULL, username VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE abonnement');
        $this->addSql('DROP TABLE calendrier_prestataires');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE demande');
        $this->addSql('DROP TABLE devis');
        $this->addSql('DROP TABLE evenement');
        $this->addSql('DROP TABLE message');
        $this->addSql('DROP TABLE prestataire');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE utilisateur');
    }
}
