DROP TABLE IF EXISTS compte CASCADE;
DROP TABLE IF EXISTS parametre CASCADE;
DROP TABLE IF EXISTS proprietes CASCADE;
DROP TABLE IF EXISTS partie CASCADE;
DROP TABLE IF EXISTS joueur CASCADE;
DROP TABLE IF EXISTS parties_en_cours CASCADE;
DROP TABLE IF EXISTS proprietes_joueur CASCADE;

CREATE TABLE joueur(
   id_joueur SERIAL PRIMARY KEY,
   pseudo VARCHAR(50) UNIQUE NOT NULL,
   parties_jouees INTEGER DEFAULT 0,
   parties_gagnees INTEGER DEFAULT 0,
   derniere_connex TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE partie(
   idPartie SERIAL PRIMARY KEY,
   joueurHostId INTEGER NOT NULL,
   status VARCHAR(50) DEFAULT 'attente',
   dateCreation TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   dateFin TIMESTAMP,
   FOREIGN KEY(joueurHostId) REFERENCES joueur(id_joueur)
);

CREATE TABLE proprietes(
   id_proprietes SERIAL PRIMARY KEY,
   nomPropriete VARCHAR(100) NOT NULL,
   type_systeme VARCHAR(50) NOT NULL,
   prix_achat INTEGER NOT NULL,
   loyer_base INTEGER NOT NULL,
   prix_amelioration INTEGER NOT NULL,
   position_plateau INTEGER NOT NULL UNIQUE,
   couleur VARCHAR(30)
);

CREATE TABLE parametre(
   id_parametre SERIAL PRIMARY KEY,
   fond VARCHAR(50) DEFAULT 'default',
   id_joueur INTEGER NOT NULL UNIQUE,
   FOREIGN KEY(id_joueur) REFERENCES joueur(id_joueur)
);

CREATE TABLE compte(
   id_compte SERIAL PRIMARY KEY,
   username VARCHAR(50) UNIQUE NOT NULL,
   mdp VARCHAR(255) NOT NULL,
   email VARCHAR(100) UNIQUE NOT NULL,
   dateCompte TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
   id_joueur INTEGER NOT NULL UNIQUE,
   FOREIGN KEY(id_joueur) REFERENCES joueur(id_joueur)
);

CREATE TABLE parties_en_cours (
    id SERIAL PRIMARY KEY,
    joueur_id INT REFERENCES joueur(id_joueur),
    position_actuelle INT DEFAULT 0,
    argent INT DEFAULT 1500,
    dernier_lancer INT DEFAULT 0,
    date_derniere_action TIMESTAMP DEFAULT NOW(),
    partie_active BOOLEAN DEFAULT TRUE
);

CREATE TABLE proprietes_joueur (
    id SERIAL PRIMARY KEY,
    joueur_id INT REFERENCES joueur(id_joueur),
    propriete_id INT REFERENCES proprietes(id_proprietes),
    niveau_amelioration INT DEFAULT 0,
    hypothequee BOOLEAN DEFAULT FALSE,
    date_achat TIMESTAMP DEFAULT NOW()
);