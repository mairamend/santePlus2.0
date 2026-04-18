<?php
require_once 'app/Database.php';

$pdo = Database::getConnexion();

// $sql = "INSERT INTO patients (nom, prenom, date_naissance, telephone, adresse) VALUES
// ('Diallo', 'Amadou', '1985-05-12', '771234567', 'Médina, Rue 22, Dakar'),
// ('Sow', 'Mariama', '1992-10-25', '785554433', 'HLM 5, Villa 124, Dakar'),
// ('Diop', 'Moussa', '1978-03-08', '709876543', 'Quartier Escale, Saint-Louis'),
// ('Fall', 'Fatou', '2000-12-15', '761112233', 'Cité Keur Gorgui, Dakar'),
// ('Ndiaye', 'Ibrahima', '1965-07-20', '774445566', 'Mbour, Quartier Tefess'),
// ('Gueye', 'Astou', '1989-01-30', '782223344', 'Parcelles Assainies, U15'),
// ('Kane', 'Ousmane', '1995-06-14', '701239876', 'Thies, Quartier Som'),
// ('Ba', 'Khadija', '1982-09-02', '768889900', 'Guédiawaye, Arrêt 12'),
// ('Cissé', 'Boubacar', '1970-11-11', '775556677', 'Rufisque, Rue des Forgerons'),
// ('Touré', 'Aminata', '2005-04-05', '783332211', 'Plateau, Avenue Pompidou')";
$sql1 = "
    INSERT INTO utilisateurs (nom, email, mot_de_passe, role, created_at) VALUES
('Mairame Ndiath', 'mairamendiath@santeplus.com', 'admin123', 'admin', '2026-03-11 16:43:46'),
('Dr. Arona Sarr', 'arona.sarr@santeplus.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'medecin', '2026-03-11 16:49:19'),
('Dr. Fatoumata Sy', 'fatou.sy@santeplus.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'medecin', '2026-03-11 16:49:19'),
('Dr. Jean Gomis', 'jean.gomis@santeplus.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'medecin', '2026-03-11 16:49:19'),
('Dr. Aminata Wade', 'ami.wade@santeplus.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'medecin', '2026-03-11 16:49:19'),
('Dr. Oumar Konaté', 'oumar.konate@santeplus.sn', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'medecin', '2026-03-11 16:49:19');
    ";
// $sql = "INSERT INTO medecins ( user_id, nom, specialite, email, telephone) VALUES
// ( 2, 'Dr. Arona Sarr', 'Cardiologue', 'arona.sarr@santeplus.sn', '775001020'),
// ( 3, 'Dr. Fatoumata Sy', 'Pédiatre', 'fatou.sy@santeplus.sn', '786003040'),
// ( 4, 'Dr. Jean Gomis', 'Généraliste', 'jean.gomis@santeplus.sn', '704005060'),
// ( 5, 'Dr. Aminata Wade', 'Gynécologue', 'ami.wade@santeplus.sn', '763007080'),
// ( 6, 'Dr. Oumar Konaté', 'Ophtalmologue', 'oumar.konate@santeplus.sn', '772009010')";

// $pdo->exec($sql);
$pdo->exec($sql1);

echo "Medecins de test ajoutés avec succès !";