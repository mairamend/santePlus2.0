<?php 
class Database{
    
    
    private static  $connexion = null;
    public static function getConnexion(){
        if(self::$connexion === null)
            try{
                $path = __DIR__ . '/../santeplus.sqlite';
                self::$connexion = new PDO("sqlite:$path");
                self::$connexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                
        }catch (PDOException $e){
                die("Erreur de connexion : " .$e->getMessage());
        }
        return self::$connexion;
    }
}