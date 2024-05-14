<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240509224812 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE prestataire ADD email VARCHAR(255) NOT NULL, ADD mot_de_passe VARCHAR(255) NOT NULL, ADD siret VARCHAR(14) NOT NULL, ADD prenom VARCHAR(255) NOT NULL, ADD pseudo VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A26480E7927C74 ON prestataire (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A2648026E94372 ON prestataire (siret)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_60A2648086CC499D ON prestataire (pseudo)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_60A26480E7927C74 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A2648026E94372 ON prestataire');
        $this->addSql('DROP INDEX UNIQ_60A2648086CC499D ON prestataire');
        $this->addSql('ALTER TABLE prestataire DROP email, DROP mot_de_passe, DROP siret, DROP prenom, DROP pseudo');
    }
}
