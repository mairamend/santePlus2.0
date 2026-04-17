<?php 
require_once '../app/models/Patient.php';
class PatientController{
   
    public function store(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $errors = [] ;
            $nom = trim(htmlspecialchars($_POST['nom']));
            $prenom = trim(htmlspecialchars($_POST['prenom']));
            $tel = trim(htmlspecialchars($_POST['telephone']));
            $date_n = $_POST['date_naissance'];
            $adresse = trim(htmlspecialchars($_POST['adresse']));

            if (empty($nom)) $errors[] = "Le nom est obligatoire.";
            if (empty($prenom)) $errors[] = "Le prénom est obligatoire.";
            if (empty($tel)) $errors[] = "Le téléphone  est obligatoire.";
            if (empty($adresse)) $errors[] = "Le l'adresse est obligatoire.";
            if (empty($date_n)) $errors[] = "Le date de naissance est obligatoire.";

            if (!preg_match("/^(77|78|70|76|75|71|72)[0-9]{7}$/", str_replace(' ', '', $tel))) {
                $errors[] = "Le format du numéro de téléphone est invalide.";
            }
            if (!empty($errors)) {
            
            $_SESSION['errors'] = $errors;
            header('Location: /patients'); 
            exit;
            }
            $patientModel = new Patient();
            $data = [
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => $date_n,
                'telephone' => $tel,
                'adresse' => $adresse
            ];
            if ($patientModel->save($data)) {
                $_SESSION['success'] = "Patient ajouté avec succès !";
                header('Location: /patients');
                exit;
            }
        }
    }
    public function destroy(){
        if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])){
            $id = intval($_POST['id']);

            if (Patient::delete($id)) {
                $_SESSION['success'] = "Patient supprimé avec succès.";
            }else{
                $_SESSION['error'] = "Erreur lors de la suppression.";
            }
        }
        header('Location: /patients');
        exit;
    }
    public function getPatientJson(){
        $id = $_GET['id'] ?? null;
        if ($id){
            $patient = Patient::find($id);
            header('Content_Type: application/json');
            echo json_encode($patient);
            exit;
        }
    }
    public function update(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $errors = [] ;
            $nom = trim(htmlspecialchars($_POST['nom']));
            $prenom = trim(htmlspecialchars($_POST['prenom']));
            $tel = trim(htmlspecialchars($_POST['telephone']));
            $date_n = $_POST['date_naissance'];
            $adresse = trim(htmlspecialchars($_POST['adresse']));

            if (empty($nom)) $errors[] = "Le nom est obligatoire.";
            if (empty($prenom)) $errors[] = "Le prénom est obligatoire.";
            if (empty($tel)) $errors[] = "Le téléphone  est obligatoire.";
            if (empty($adresse)) $errors[] = "Le l'adresse est obligatoire.";
            if (empty($date_n)) $errors[] = "Le date de naissance est obligatoire.";

            if (!preg_match("/^(77|78|70|76|75|71|72)[0-9]{7}$/", str_replace(' ', '', $tel))) {
                $errors[] = "Le format du numéro de téléphone est invalide.";
            }
            if (!empty($errors)) {
            
            $_SESSION['errors'] = $errors;
            header('Location: /patients'); 
            exit;
            }
            $data = [
                'nom' => $nom,
                'prenom' => $prenom,
                'date_naissance' => $date_n,
                'telephone' => $tel,
                'adresse' => $adresse
            ];
            $model = new Patient();
            if($model->save($data,$id)){
                $_SESSION['success'] = 'Patient mis à jour !';
            }
            header('Location: /patients');
            exit;
        }
    }
    public function index(){
        $page = 'patients';
         // Logique de pagination
        $page_courante = isset($_GET['p']) ? max(1, intval($_GET['p'])) : 1;
        $par_page = 5 ;
        $offset = ($page_courante - 1) * $par_page;
        $search = $_GET['search'] ?? '';
        // Récupération des données via le modèle
        if($search !== ''){
            $patients = Patient::search($search,$par_page,$offset);
            $total = Patient::countSearch($search);
        }else{
            $patients = Patient::all($par_page,$offset);
            $total = Patient::count();
        }
        $nb_pages = ceil($total / $par_page);
        include __DIR__  .'/../../views/patients/list.php';
    }
}