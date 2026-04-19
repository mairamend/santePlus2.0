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
    public function getMedecinJson(){
        $id = $_GET['id'] ?? null;
        if($id){
            $medecin = Medecin::find($id);
            header('Content-Type: application/json');
            echo json_encode($medecin);
            exit;
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = [];
            $id = $_POST['id'];
            $userId = $_POST['user_id'];
            $nom = trim(htmlspecialchars($_POST['nom']));
            $specialite = trim(htmlspecialchars($_POST['specialite']));
            $email = trim(htmlspecialchars($_POST['email']));
            $telephone = trim(htmlspecialchars($_POST['telephone']));
            
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
                
            ];
            if ($userModel->save($dataUser,$userId)){
                $medecinModel = new Medecin();
                $medecinData = [
                'nom' => $nom,
                'specialite' => $specialite,
                'email' => $email,
                'telephone' => $telephone,
                
                ];
                if ($medecinModel->save($medecinData,$id)) {
                    $_SESSION['success'] = "Médecin Modifié avec succés avec succès !";
                }else {
                    
                    $_SESSION['errors'] = ["Erreur lors de la modification du medecin."];
                }
            }
                header('Location: /medecins');
                exit;
             
        }
    }
    public function destroy(){
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
        $id = intval($_POST['id']);
        
        // 1. Récupérer les infos du médecin pour avoir le user_id
        $medecin = Medecin::find($id);
        
        if($medecin) {
            $userId = $medecin['user_id'];
            
            // 2. Supprimer d'abord le profil médecin
            if(Medecin::delete($id)){
                // 3. Puis supprimer le compte utilisateur
                if(User::delete($userId)){
                    $_SESSION['success'] = 'Médecin et son compte utilisateur supprimés avec succès.';
                } else {
                    $_SESSION['success'] = 'Profil supprimé, mais le compte utilisateur a échoué.';
                }
            } else {
                $_SESSION['error'] = "Erreur lors de la suppression du profil médecin.";
            }
        } else {
            $_SESSION['error'] = "Médecin introuvable.";
        }
    }
    header('Location: /medecins');
    exit;
}
}
