CREATE TABLE utilisateurs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    email VARCHAR(150) UNIQUE NOT NULL,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('client', 'admin') DEFAULT 'client',
    telephone VARCHAR(20),
    adresse TEXT,
    permis_numero VARCHAR(50),
    statut BOOLEAN DEFAULT TRUE,
    date_inscription DATETIME DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE categories (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50) UNIQUE NOT NULL,
    description TEXT,
    disponible BOOLEAN DEFAULT TRUE
);
CREATE TABLE vehicules (
    id INT PRIMARY KEY AUTO_INCREMENT,
    marque VARCHAR(50) NOT NULL,
    modele VARCHAR(50) NOT NULL,
    annee INT,
    immatriculation VARCHAR(20) UNIQUE,
    categorie_id INT,
    prix_journalier DECIMAL(10, 2) NOT NULL,
    nb_places INT DEFAULT 5,
    description TEXT,
    image_url VARCHAR(255),
    disponible BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (categorie_id) REFERENCES categories(id)
);

ALTER TABLE vehicules ADD COLUMN carburant enum ("essence", "electrique", "hybride", "diesel") DEFAULT "essence";

CREATE TABLE reservations (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    vehicule_id INT,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    lieu_priseencharge VARCHAR(255),
    lieu_retour VARCHAR(255),
    prix_total DECIMAL(10,2),
    statut ENUM('en_attente', 'confirmee', 'annulee') DEFAULT 'en_attente',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (client_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id)
);

CREATE TABLE avis (
    id INT PRIMARY KEY AUTO_INCREMENT,
    client_id INT,
    vehicule_id INT,
    reservation_id INT,
    note INT CHECK (note >= 1 AND note <= 5),
    commentaire TEXT,
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    
    FOREIGN KEY (client_id) REFERENCES utilisateurs(id),
    FOREIGN KEY (vehicule_id) REFERENCES vehicules(id),
    FOREIGN KEY (reservation_id) REFERENCES reservations(id)
);

INSERT INTO categories (nom, description) VALUES
('Berline', 'Véhicules familiaux confortables'),
('SUV', 'Véhicules tout-terrain spacieux'),
('Sport', 'Véhicules performants'),
('Électrique', 'Véhicules écologiques'),
('Citadine', 'Petits véhicules urbains');



INSERT INTO utilisateurs (nom, email, mot_de_passe, role, telephone, permis_numero) VALUES
('Admin System', 'admin@mabagnole.fr', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', '01 23 45 67 89', NULL),
('Jean Dupont', 'jean@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', '06 12 34 56 78', '123456789'),
('Marie Martin', 'marie@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'client', '06 23 45 67 89', '987654321');


INSERT INTO vehicules (marque, modele, annee, immatriculation, categorie_id, prix_journalier, carburant, nb_places, description, image_url, disponible) VALUES
('Renault', 'Clio', 2022, 'AB-123-CD', 5, 35.00, 'essence', 5, 'Citadine économique et maniable', 'clio.jpg', TRUE),
('Peugeot', '3008', 2023, 'EF-456-GH', 2, 75.00, 'diesel', 5, 'SUV familial spacieux', '3008.jpg', TRUE),
('Tesla', 'Model 3', 2023, 'IJ-789-KL', 4, 90.00, 'électrique', 5, 'Berline électrique performante', 'tesla.jpg', TRUE),
('BMW', 'Série 3', 2022, 'MN-012-OP', 1, 85.00, 'essence', 5, 'Berline sportive premium', 'bmw.jpg', TRUE),
('Audi', 'A1', 2023, 'QR-345-ST', 5, 45.00, 'essence', 4, 'Citadine premium compacte', 'audi.jpg', TRUE),
('Toyota', 'RAV4', 2023, 'UV-678-WX', 2, 80.00, 'hybride', 5, 'SUV hybride économique', 'toyota.jpg', TRUE);


INSERT INTO reservations (client_id, vehicule_id, date_debut, date_fin, lieu_priseencharge, lieu_retour, prix_total, statut) VALUES
(2, 1, '2024-01-15', '2024-01-20', 'Agence Paris Centre', 'Agence Paris Centre', 175.00, 'confirmee'),
(3, 3, '2024-01-10', '2024-01-12', 'Agence Lyon', 'Agence Lyon', 180.00, 'confirmee');


INSERT INTO avis (client_id, vehicule_id, reservation_id, note, commentaire) VALUES
(2, 1, 1, 4, 'Très bon véhicule, économique et facile à conduire.'),
(3, 3, 2, 5, 'Exceptionnel ! Conduite fluide et technologie impressionnante.');



create liste_vehicule as select * from vehicule v join categories c on v.categorie_id = c.id


use ma_bagnole

select * from vehicules v left join categories c on v.categorie_id = c.id left join avis a on v.id = a.vehicule_id;

select * from utilisateurs where email = "admin@mabagnole.fr"


CREATE VIEW ListeVehicules AS
SELECT 
    v.id,
    v.marque,
    v.modele,
    v.annee,
    v.prix_journalier,
    v.carburant,
    v.nb_places,
    v.image_url,
    v.disponible,

    c.nom AS categorie,

    ROUND(AVG(a.note), 1) AS note_moyenne,
    COUNT(a.id) AS total_avis

FROM vehicules v
JOIN categories c ON v.categorie_id = c.id
LEFT JOIN avis a ON v.id = a.vehicule_id

GROUP BY v.id;


CREATE OR REPLACE VIEW liste_vehicules AS
SELECT 
   v.*,
    c.nom AS categorie,
    AVG(a.note) AS note_moyenne
FROM vehicules v
JOIN categories c ON v.categorie_id = c.id
LEFT JOIN avis a ON v.id = a.vehicule_id
GROUP BY v.id;


SELECT 
   v.*,
    c.nom AS categorie,
    AVG(a.note) AS note_moyenne
FROM vehicules v
JOIN categories c ON v.categorie_id = c.id
LEFT JOIN avis a ON v.id = a.vehicule_id
GROUP BY v.id;



