<?php
require_once '../app/models/Medecin.php';
require_once '../app/models/User.php';
class MedecinController{
    public function index(){
        $page = 'medecins';
        $specialites = Medecin::getAllSpeciality();
        // Paginatination
        $page_courante = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        $par_page = 6 ;
        $offset = ($page_courante - 1) * $par_page;
        $filter = $_GET['specialite'] ?? '';
        // Récupération des données via le modèle
        if($filter !== ''){
            $medecins = Medecin::filterBySpeciality($filter,$par_page,$offset);
            $total = Medecin::countFilter($filter) ;  
            
        }else{
            $medecins = Medecin::all($par_page,$offset);
            $total = Medecin::count();
        }
        $nb_pages = ceil($total / $par_page);
        include __DIR__ .'/../../views/medecins/list.php';
    }
    public function store(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = [];
            $nom = trim(htmlspecialchars($_POST['nom']));
            $specialite = trim(htmlspecialchars($_POST['specialite']));
            $email = trim(htmlspecialchars($_POST['email']));
            $telephone = trim(htmlspecialchars($_POST['telephone']));
            $motdepasse = password_hash("passer123", PASSWORD_DEFAULT);
            if (empty($nom)) $errors[] = "Le nom est obligatoire.";
            if (empty($specialite)) $errors[] = "La specialite est obligatoire.";
            if (empty($email)) $errors[] = "Le email est obligatoire.";
            if (empty($telephone)) $errors[] = "Le telephone est obligatoire.";

             if (!preg_match("/^(77|78|70|76|75|71|72)[0-9]{7}$/", str_replace(' ', '', $telephone))) {
                $errors[] = "Le format du numéro de téléphone est invalide.";
            }
            if(!empty($errors)){
                $_SESSION['errors'] = $errors;
                header('Location: /medecins');
                exit;
            }
            $userModel = new User();
            
            $dataUser = [
                'nom' => $nom,
                'email' => $email,
                'mot_de_passe' => $motdepasse,
                'role' => 'medecin'
            ];
            $userId = $userModel->save($dataUser);

            if($userId)
            {
              
                $medecinModel = new Medecin();
                $medecinData = [
                'nom' => $nom,
                'specialite' => $specialite,
                'email' => $email,
                'telephone' => $telephone,
                'user_id' => $userId
                ];
                if ($medecinModel->save($medecinData)) {
                    $_SESSION['success'] = "Médecin créé avec succès !";
                }else {
                    
                    $_SESSION['errors'] = ["Erreur lors de la création du profil professionnel."];
                }
            }
            header('Location: /medecins');
            exit;
        }
    }
}