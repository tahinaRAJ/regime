USE regime;

INSERT INTO user (name, email, password, genre, role) VALUES
('Jean Dupont',   'jean@test.fr',   'Admin@1234',  'Homme', 'admin'),
('Marie Lambert', 'marie@test.fr',  'Admin@5678',  'Femme', 'admin'),
('Thomas Martin', 'thomas@test.fr', 'Client@9012', 'Homme', 'client');

INSERT INTO caracteristique (idUser, age, height, weight) VALUES
(1, 35, 178, 85.50),  -- Jean (admin)
(2, 28, 165, 62.00),  -- Marie (admin)
(3, 42, 180, 95.30);  -- Thomas (client)
