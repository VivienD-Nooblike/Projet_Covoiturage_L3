<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200322123547 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_1D1C63B3BA9CD190');
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, commentaire_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL COLLATE BINARY, prenom VARCHAR(255) NOT NULL COLLATE BINARY, date_naissance DATE NOT NULL, email VARCHAR(255) NOT NULL COLLATE BINARY, telephone VARCHAR(255) NOT NULL COLLATE BINARY, mot_de_passe VARCHAR(255) NOT NULL COLLATE BINARY, CONSTRAINT FK_1D1C63B3BA9CD190 FOREIGN KEY (commentaire_id) REFERENCES Commentaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO utilisateur (id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe) SELECT id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE INDEX IDX_1D1C63B3BA9CD190 ON utilisateur (commentaire_id)');
        $this->addSql('DROP INDEX IDX_28C79E89BA9CD190');
        $this->addSql('DROP INDEX IDX_28C79E89D12A823');
        $this->addSql('CREATE TEMPORARY TABLE __temp__covoiturage AS SELECT id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration FROM covoiturage');
        $this->addSql('DROP TABLE covoiturage');
        $this->addSql('CREATE TABLE covoiturage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER NOT NULL, commentaire_id INTEGER DEFAULT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, passager CLOB DEFAULT NULL COLLATE BINARY --(DC2Type:array)
        , description VARCHAR(255) DEFAULT NULL COLLATE BINARY, nb_place INTEGER NOT NULL, prix INTEGER NOT NULL, disponibilite BOOLEAN NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, date_expiration DATE NOT NULL, CONSTRAINT FK_AE5B115ED12A823 FOREIGN KEY (trajet_id) REFERENCES trajet (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_AE5B115EBA9CD190 FOREIGN KEY (commentaire_id) REFERENCES Commentaire (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO covoiturage (id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration) SELECT id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration FROM __temp__covoiturage');
        $this->addSql('DROP TABLE __temp__covoiturage');
        $this->addSql('CREATE INDEX IDX_AE5B115ED12A823 ON covoiturage (trajet_id)');
        $this->addSql('CREATE INDEX IDX_AE5B115EBA9CD190 ON covoiturage (commentaire_id)');
        $this->addSql('DROP INDEX IDX_96E46B0DFB88E14F');
        $this->addSql('DROP INDEX IDX_96E46B0D62671590');
        $this->addSql('CREATE TEMPORARY TABLE __temp__covoiturage_utilisateur AS SELECT covoiturage_id, utilisateur_id FROM covoiturage_utilisateur');
        $this->addSql('DROP TABLE covoiturage_utilisateur');
        $this->addSql('CREATE TABLE covoiturage_utilisateur (covoiturage_id INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, PRIMARY KEY(covoiturage_id, utilisateur_id), CONSTRAINT FK_96E46B0D62671590 FOREIGN KEY (covoiturage_id) REFERENCES Covoiturage (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_96E46B0DFB88E14F FOREIGN KEY (utilisateur_id) REFERENCES utilisateur (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO covoiturage_utilisateur (covoiturage_id, utilisateur_id) SELECT covoiturage_id, utilisateur_id FROM __temp__covoiturage_utilisateur');
        $this->addSql('DROP TABLE __temp__covoiturage_utilisateur');
        $this->addSql('CREATE INDEX IDX_96E46B0DFB88E14F ON covoiturage_utilisateur (utilisateur_id)');
        $this->addSql('CREATE INDEX IDX_96E46B0D62671590 ON covoiturage_utilisateur (covoiturage_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_AE5B115ED12A823');
        $this->addSql('DROP INDEX IDX_AE5B115EBA9CD190');
        $this->addSql('CREATE TEMPORARY TABLE __temp__Covoiturage AS SELECT id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration FROM Covoiturage');
        $this->addSql('DROP TABLE Covoiturage');
        $this->addSql('CREATE TABLE Covoiturage (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, trajet_id INTEGER NOT NULL, commentaire_id INTEGER DEFAULT NULL, date_depart DATE NOT NULL, date_arrivee DATE NOT NULL, passager CLOB DEFAULT NULL --(DC2Type:array)
        , description VARCHAR(255) DEFAULT NULL, nb_place INTEGER NOT NULL, prix INTEGER NOT NULL, disponibilite BOOLEAN NOT NULL, date_creation DATE NOT NULL, date_modification DATE NOT NULL, date_expiration DATE NOT NULL)');
        $this->addSql('INSERT INTO Covoiturage (id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration) SELECT id, trajet_id, commentaire_id, date_depart, date_arrivee, passager, description, nb_place, prix, disponibilite, date_creation, date_modification, date_expiration FROM __temp__Covoiturage');
        $this->addSql('DROP TABLE __temp__Covoiturage');
        $this->addSql('CREATE INDEX IDX_28C79E89BA9CD190 ON Covoiturage (commentaire_id)');
        $this->addSql('CREATE INDEX IDX_28C79E89D12A823 ON Covoiturage (trajet_id)');
        $this->addSql('DROP INDEX IDX_96E46B0D62671590');
        $this->addSql('DROP INDEX IDX_96E46B0DFB88E14F');
        $this->addSql('CREATE TEMPORARY TABLE __temp__covoiturage_utilisateur AS SELECT covoiturage_id, utilisateur_id FROM covoiturage_utilisateur');
        $this->addSql('DROP TABLE covoiturage_utilisateur');
        $this->addSql('CREATE TABLE covoiturage_utilisateur (covoiturage_id INTEGER NOT NULL, utilisateur_id INTEGER NOT NULL, PRIMARY KEY(covoiturage_id, utilisateur_id))');
        $this->addSql('INSERT INTO covoiturage_utilisateur (covoiturage_id, utilisateur_id) SELECT covoiturage_id, utilisateur_id FROM __temp__covoiturage_utilisateur');
        $this->addSql('DROP TABLE __temp__covoiturage_utilisateur');
        $this->addSql('CREATE INDEX IDX_96E46B0D62671590 ON covoiturage_utilisateur (covoiturage_id)');
        $this->addSql('CREATE INDEX IDX_96E46B0DFB88E14F ON covoiturage_utilisateur (utilisateur_id)');
        $this->addSql('DROP INDEX IDX_1D1C63B3BA9CD190');
        $this->addSql('CREATE TEMPORARY TABLE __temp__utilisateur AS SELECT id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe FROM utilisateur');
        $this->addSql('DROP TABLE utilisateur');
        $this->addSql('CREATE TABLE utilisateur (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, commentaire_id INTEGER DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATE NOT NULL, email VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, mot_de_passe VARCHAR(255) NOT NULL)');
        $this->addSql('INSERT INTO utilisateur (id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe) SELECT id, commentaire_id, nom, prenom, date_naissance, email, telephone, mot_de_passe FROM __temp__utilisateur');
        $this->addSql('DROP TABLE __temp__utilisateur');
        $this->addSql('CREATE INDEX IDX_1D1C63B3BA9CD190 ON utilisateur (commentaire_id)');
    }
}
