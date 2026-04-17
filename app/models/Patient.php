<?php
require_once '../app/Model.php';
class Patient extends Model{
    protected static $table = 'patients';
    public static function search($term,$limit,$offset){
        $db = Database::getConnexion();
        $sql = "SELECT * FROM patients 
        WHERE nom LIKE :term OR prenom LIKE :term OR telephone LIKE :term
        LIMIT :limit OFFSET :offset";

        $stmt = $db->prepare($sql);
        $stmt->bindValue(':term', "%$term%", PDO::PARAM_STR);
        $stmt->bindValue(':limit', $limit , PDO::PARAM_INT);
        $stmt->bindValue(':offset',$offset , PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public static function countSearch($term){
        $db = Database::getConnexion();
        $stmt = $db->prepare("SELECT COUNT(*) FROM patients WHERE nom LIKE :term OR prenom LIKE :term OR telephone LIKE :term");
        $stmt->execute([':term' => "%$term%"]);
        return $stmt->fetchColumn();
    }
}