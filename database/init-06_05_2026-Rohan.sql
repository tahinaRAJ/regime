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
    poidsInfluence DECIMAL(10, 2) NOT NULL, -- Ex: -2.5 (kg) ou +1.5 (kg)
    dureeInfluence INT,            
    pourcentageViande DECIMAL(5, 2),
    pourcentagePoisson DECIMAL(5, 2),
    pourcentageVolaille DECIMAL(5, 2)
);
CREATE TABLE activity (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    poidsInfluence DECIMAL(10, 2) NOT NULL
);

CREATE TABLE objectif (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE option(
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL
);

CREATE TABLE userOption (
    idUser INT NOT NULL PRIMARY KEY,
    idOption INT NOT NULL PRIMARY KEY,
    FOREIGN KEY (idUser) REFERENCES user (id),
    FOREIGN KEY (idOption) REFERENCES option (id)
);

CREATE TABLE code(
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

CREATE TABLE paiement(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUserOption INT NOT NULL,
    datePaiement DATETIME NOT NULL,
    FOREIGN KEY (idUserOption) REFERENCES userOption (id)
);

CREATE TABLE choixUser(
    id INT PRIMARY KEY AUTO_INCREMENT,
    idUser INT NOT NULL,
    idObjectif INT NOT NULL,
    idRegime INT NOT NULL,
    idActivity INT NOT NULL,
    FOREIGN KEY (idUser) REFERENCES user (id),
    FOREIGN KEY (idObjectif) REFERENCES objectif (id),
    FOREIGN KEY (idRegime) REFERENCES regime (id),
    FOREIGN KEY (idActivity) REFERENCES activity (id),
    dateChoix DATETIME NOT NULL
);

ALTER TABLE user
ADD COLUMN role ENUM('client', 'admin') NOT NULL DEFAULT 'client';