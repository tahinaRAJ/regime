-- SQLBook: Code
USE regime;
INSERT INTO activite (nom, poidsInfluenceActivite) VALUES 
('Course à pied', -0.50),
('Musculation', 0.80),
('Yoga', -0.10);

-- Insertion des régimes
INSERT INTO regime (nom, description, prixJournalier, poidsInfluencefood, dureeInfluencefood, idActivite, poidsInfluenceActivite, pourcentageViande, pourcentagePoisson, pourcentageVolaille) VALUES 
('Régime Minceur Extrême', 'Idéal pour une perte de poids rapide', 15.50, -1.50, 7, 1, -0.50, 20.00, 50.00, 30.00),
('Régime Prise de Masse', 'Riche en protéines pour les sportifs', 22.00, 2.00, 7, 2, 0.80, 50.00, 20.00, 30.00),
('Régime Équilibré', 'Maintien et bien-être quotidien', 12.00, 0.00, 7, 3, -0.10, 33.33, 33.33, 33.34);
INSERT INTO regime (nom, description, prixJournalier, poidsInfluencefood, dureeInfluencefood, idActivite, poidsInfluenceActivite, pourcentageViande, pourcentagePoisson, pourcentageVolaille) VALUES 
('Régime Low Carb Minceur', 'Réduction des glucides pour affiner la silhouette', 18.00, -1.20, 7, 1, -0.50, 25.00, 45.00, 30.00),
('Régime Hyperprotéiné Force', 'Optimisation musculaire et récupération', 25.50, 1.80, 7, 2, 0.80, 55.00, 15.00, 30.00);
-- Insertion des options pour les utilisateurs (basé sur Jean, Marie, Thomas)
INSERT INTO userOption (idUser, idOption) VALUES 
(1, 1), -- Jean a pris le coaching
(3, 1), -- Thomas a pris le coaching
(3, 2); -- Thomas a aussi pris le suivi médical

-- Insertion des codes proportionnels ou de réduction
INSERT INTO code (nom, montant, isValid) VALUES 
('PROMO26', 40000.00, TRUE),
('WELCOME10', 500000.00, TRUE),
('EXPIRED50', 50.00, FALSE);

-- Insertion des portefeuilles utilisateurs
INSERT INTO portemonaie (idUser, montant) VALUES 
(1, 150.00),
(2, 500.00),
(3, 50.00);

-- Insertion des paiements (liés aux users de userOption)
INSERT INTO paiement (idUser, datePaiement) VALUES 
(1, '2026-05-01 10:30:00'),
(3, '2026-05-05 14:15:00');

-- Insertion des choix d'utilisateurs
INSERT INTO choixUser (idUser, idObjectif, idRegime, durée, dateChoix) VALUES 
(1, 2, 2, 30, '2026-05-02 09:00:00'), -- Jean a choisi Prise de masse
(2, 3, 3, 15, '2026-05-03 11:20:00'), -- Marie a choisi le régime équilibré
(3, 1, 1, 60, '2026-05-06 08:45:00'); -- Thomas a choisi la perte de poids

