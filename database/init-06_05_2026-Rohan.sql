-- Active: 1765287408229@@127.0.0.1@3306
CREATE DATABASE regime;

USE regime;

CREATE TABLE user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    genre ENUM('Homme', 'Femme') NOT NULL
);

CREATE TABLE caracteristique (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    age INT NOT NULL,
    height DECIMAL(10, 2) NOT NULL,
    weight DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idUser) REFERENCES user (id)
);

CREATE TABLE regime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prixJournalier DECIMAL(10, 2) NOT NULL, -- Prix de base
    poidsInfluencefood DECIMAL(10, 2) NOT NULL, -- Ex: -2.5 (kg) ou +1.5 (kg)
    dureeInfluencefood INT,
    idActivite INT,
    poidsInfluenceActivite DECIMAL(10, 2) NOT NULL,
    pourcentageViande DECIMAL(5, 2),
    pourcentagePoisson DECIMAL(5, 2),
    pourcentageVolaille DECIMAL(5, 2), FOREIGN KEY (idActivite) REFERENCES activite (id)
);

CREATE TABLE objectif (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE option (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE userOption (
    idUser INT NOT NULL,
    idOption INT NOT NULL,
    PRIMARY KEY (idUser, idOption),
    FOREIGN KEY (idUser) REFERENCES user (id),
    FOREIGN KEY (idOption) REFERENCES option (id)
);

CREATE TABLE code (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    isValid BOOLEAN NOT NULL
);

CREATE TABLE portemonaie (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    montant DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (idUser) REFERENCES user (id)
);

CREATE TABLE paiement (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    datePaiement DATETIME NOT NULL,
    FOREIGN KEY (idUser) REFERENCES userOption (idUser)
);

CREATE TABLE choixUser (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    idObjectif INT NOT NULL,
    idRegime INT NOT NULL,
    durée INT NOT NULL, -- Durée en jours
    FOREIGN KEY (idUser) REFERENCES user (id),
    FOREIGN KEY (idObjectif) REFERENCES objectif (id),
    FOREIGN KEY (idRegime) REFERENCES regime (id),
    dateChoix DATETIME NOT NULL
);

CREATE TABLE activite (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    poidsInfluenceActivite DECIMAL(10, 2) NOT NULL
);

ALTER TABLE user
ADD COLUMN role ENUM('client', 'admin') NOT NULL DEFAULT 'client';

Insert into objectif (nom) values ('Perdre du poids');

Insert into objectif (nom) values ('Gagner du poids');

Insert into objectif (nom) values ('Atteindre un imc ideal');

/* standard et gold sont les deux options disponibles pour les clients */
Insert into option (nom) values ('Standard');

Insert into option (nom) values ('Gold');