<?php
require_once 'app/Database.php';

$pdo = Database::getConnexion();

$sql = "INSERT INTO patients (nom, prenom, date_naissance, telephone, adresse) VALUES
('Diallo', 'Amadou', '1985-05-12', '771234567', 'Médina, Rue 22, Dakar'),
('Sow', 'Mariama', '1992-10-25', '785554433', 'HLM 5, Villa 124, Dakar'),
('Diop', 'Moussa', '1978-03-08', '709876543', 'Quartier Escale, Saint-Louis'),
('Fall', 'Fatou', '2000-12-15', '761112233', 'Cité Keur Gorgui, Dakar'),
('Ndiaye', 'Ibrahima', '1965-07-20', '774445566', 'Mbour, Quartier Tefess'),
('Gueye', 'Astou', '1989-01-30', '782223344', 'Parcelles Assainies, U15'),
('Kane', 'Ousmane', '1995-06-14', '701239876', 'Thies, Quartier Som'),
('Ba', 'Khadija', '1982-09-02', '768889900', 'Guédiawaye, Arrêt 12'),
('Cissé', 'Boubacar', '1970-11-11', '775556677', 'Rufisque, Rue des Forgerons'),
('Touré', 'Aminata', '2005-04-05', '783332211', 'Plateau, Avenue Pompidou')";

$pdo->exec($sql);

echo "Patients de test ajoutés avec succès !";