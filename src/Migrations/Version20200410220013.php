<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200410220013 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, commentaire_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL)');
        $this->addSql('CREATE INDEX IDX_1D1C63B3BA9CD190 ON utilisateur (commentaire_id)');
        $this->addSql('CREATE TABLE trajet (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, itineraire VARCHAR(255) NOT NULL, depart VARCHAR(255) NOT NULL, destination VARCHAR(255) NOT NULL, adresse_depart VARCHAR(255) NOT NULL, adresse_arrivee VARCHAR(255) NOT NULL, temps_trajet DATE DEFAULT NULL)');
        $this->addSql('CREATE TABLE Commentaire (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, note INTEGER DEFAULT NULL, commentaire VARCHAR(255) DEFAULT NULL, date_creation DATE DEFAULT NULL, date_modification DATE DEFAULT NULL)');
        $this->addSql('CREATE TABLE Covoiturage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER DEFAULT NULL, commentaire_id INTEGER DEFAULT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, passager CLOB DEFAULT NULL --(DC2Type:array)
        , description VARCHAR(255) DEFAULT NULL, nb_place INTEGER NOT NULL, prix INTEGER NOT NULL, disponibilite BOOLEAN NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, date_expiration DATE NOT NULL)');
        $this->addSql('CREATE INDEX IDX_AE5B115ED12A823 ON Covoiturage (trajet_id)');
        $this->addSql('CREATE INDEX IDX_AE5B115EBA9CD190 ON Covoiturage (commentaire_id)');
        $this->addSql('CREATE TABLE covoiturage_utilisateur (covoiturage_id INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, PRIMARY KEY(covoiturage_id, utilisateur_id))');
        $this->addSql('CREATE INDEX IDX_96E46B0D62671590 ON covoiturage_utilisateur (covoiturage_id)');
        $this->addSql('CREATE INDEX IDX_96E46B0DFB88E14F ON covoiturage_utilisateur (utilisateur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('DROP TABLE trajet');
        $this->addSql('DROP TABLE Commentaire');
        $this->addSql('DROP TABLE Covoiturage');
        $this->addSql('DROP TABLE covoiturage_utilisateur');
    }
}
