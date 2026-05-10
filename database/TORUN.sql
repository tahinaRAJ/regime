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

CREATE TABLE activite (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    poidsInfluenceActivite DECIMAL(10, 2) NOT NULL
);


CREATE TABLE regime (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(255) NOT NULL,
    description TEXT,
    prixJournalier DECIMAL(10, 2) NOT NULL, -- Prix de base
    poidsInfluencefood DECIMAL(10, 2) NOT NULL, -- Ex: -2.5 (kg) ou +1.5 (kg)
    dureeInfluencefood INT,
    idActivite INT,
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



ALTER TABLE user
ADD COLUMN role ENUM('client', 'admin') NOT NULL DEFAULT 'client';

Insert into objectif (nom) values ('Perdre du poids');

Insert into objectif (nom) values ('Gagner du poids');

Insert into objectif (nom) values ('Atteindre un imc ideal');

Insert into option (nom) values ('Standard');

Insert into option (nom) values ('Gold');

INSERT INTO user (name, email, password, genre, role) VALUES
('Jean Dupont',   'jean@test.fr',   'Admin@1234',  'Homme', 'admin'),
('Marie Lambert', 'marie@test.fr',  'Admin@5678',  'Femme', 'admin'),
('Thomas Martin', 'thomas@test.fr', 'Client@9012', 'Homme', 'client');

INSERT INTO caracteristique (idUser, age, height, weight) VALUES
(1, 35, 178, 85.50), 
(2, 28, 165, 62.00),
(3, 42, 180, 95.30); 

INSERT INTO activite (nom, poidsInfluenceActivite) VALUES 
('Course à pied', -0.50),
('Musculation', 0.80),
('Yoga', -0.10);

INSERT INTO regime (nom, description, prixJournalier, poidsInfluencefood, dureeInfluencefood, idActivite, pourcentageViande, pourcentagePoisson, pourcentageVolaille) VALUES 
('Régime Minceur Extrême', 'Idéal pour une perte de poids rapide', 15.50, -1.50, 7, 1, 20.00, 50.00, 30.00),
('Régime Prise de Masse', 'Riche en protéines pour les sportifs', 22.00, 2.00, 7, 2, 50.00, 20.00, 30.00),
('Régime Équilibré', 'Maintien et bien-être quotidien', 12.00, 0.00, 7, 3, 33.33, 33.33, 33.34);
INSERT INTO regime (nom, description, prixJournalier, poidsInfluencefood, dureeInfluencefood, idActivite, pourcentageViande, pourcentagePoisson, pourcentageVolaille) VALUES 
('Régime Low Carb Minceur', 'Réduction des glucides pour affiner la silhouette', 18.00, -1.20, 7, 1, 25.00, 45.00, 30.00),
('Régime Hyperprotéiné Force', 'Optimisation musculaire et récupération', 25.50, 1.80, 7, 2, 55.00, 15.00, 30.00);
INSERT INTO userOption (idUser, idOption) VALUES 
(1, 1), 
(3, 1), 
(3, 2);

INSERT INTO code (nom, montant, isValid) VALUES 
('PROMO26', 40000.00, TRUE),
('WELCOME10', 500000.00, TRUE),
('EXPIRED50', 50.00, FALSE);

INSERT INTO portemonaie (idUser, montant) VALUES 
(1, 150.00),
(2, 500.00),
(3, 50.00);

INSERT INTO paiement (idUser, datePaiement) VALUES 
(1, '2026-05-01 10:30:00'),
(3, '2026-05-05 14:15:00');

INSERT INTO choixUser (idUser, idObjectif, idRegime, durée, dateChoix) VALUES 
(1, 2, 2, 30, '2026-05-02 09:00:00'), 
(2, 3, 3, 15, '2026-05-03 11:20:00'),
(3, 1, 1, 60, '2026-05-06 08:45:00'); 

