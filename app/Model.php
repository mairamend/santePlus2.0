<?php 
abstract class Model{
    
    protected static $table;
    
    
    public static function all($limit = null, $offset = null){
        $pdo = Database::getConnexion();
        $sql = "SELECT * FROM " . static::$table;
        // On ajoute la pagination si les parametres sont fournis
        if($limit !== null){
            $sql .= " Limit :limit";
            if($offset !== null){
                $sql .= " OFFSET :offset";
                
            }
        }
        $stmt = $pdo->prepare($sql);
        if ($limit !== null) {
            $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
            if ($offset !== null) {
                $stmt->bindValue(':offset', (int)$offset, PDO::PARAM_INT);
            }
        }
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function count() {
        $db = Database::getConnexion();
        $sql = "SELECT COUNT(*) FROM " . static::$table;
        return $db->query($sql)->fetchColumn();
    }
    public static function find($id){
        $pdo = Database::getConnexion();
        $table = static::$table;
        $sql = " SELECT * FROM {$table} WHERE id = :id";
        $stmt = $pdo -> prepare ( $sql );
       
        $stmt -> execute ([':id' => $id]);
        return $stmt -> fetch (PDO :: FETCH_ASSOC );
    }
    public function save(array $data,$id=null){
        try{
        $pdo = Database::getConnexion();
        $table = static::$table;
        if($id){
            $fields = "";
            foreach($data as $key => $value){
                $fields .= "$key = :$key, ";
                
            }
            $fields = rtrim($fields,', ');
            $sql = "UPDATE $table SET $fields WHERE id = :id";
            $data['id'] = $id;
        }
        else {
            $colums = implode(', ',array_keys($data));
            $placeholders = ':' . implode(', :',array_keys($data));

            $sql = "INSERT INTO $table ($colums) VALUES ($placeholders)";
            }
            $stmt = $pdo->prepare($sql);
            if($stmt->execute($data)){
                
                return $id ?: $pdo->lastInsertId();
                
            }
        
            return false;
        }catch(PDOException $e){
            die("Erreur SQL : " . $e->getMessage());
        }
    }
    public static function delete($id){
        $pdo = Database::getConnexion();
        $table = static::$table;
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([':id' => $id]);
    }

}