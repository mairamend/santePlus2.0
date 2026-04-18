<?php 
require_once '../app/Model.php';
class Medecin extends Model{
    protected static $table = 'medecins';
    public static function filterBySpeciality($speciality,$limit,$offset){
        $db = Database::getConnexion();
        $table = static::$table;
        $sql = "SELECT * FROM $table
                WHERE specialite = :specialite
                LIMIT :limit OFFSET :offset";
        $stmt = $db->prepare($sql) ;
        $stmt->bindValue(':specialite', $speciality, PDO::PARAM_STR);       
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);       
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);       
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public static function getAllSpeciality(){
        $db = Database::getConnexion();
        $table = static::$table;
        $sql = "SELECT DISTINCT specialite FROM $table 
                ORDER BY specialite ASC";
        return $db->query($sql)->fetchAll(PDO::FETCH_COLUMN);
    }
    public static function countFilter($filter){
        $db = Database::getConnexion();
        $table = static::$table;
        $stmt = $db->prepare("SELECT COUNT(*) FROM $table WHERE specialite = :specialite ");
        $stmt->execute([':specialite' => $filter]);
        return $stmt->fetchColumn();
    }
}