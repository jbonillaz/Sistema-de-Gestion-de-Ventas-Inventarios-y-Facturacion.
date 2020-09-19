<?php

require_once "connection.php";

class ModelsUsers{
    /**Mostrar  usuarios */

    static public function Mdlshowusers($tabla, $item, $value){

        if($item != null){

        $stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
        
        $stmt -> execute();

        return $stmt -> fetch();

    }else{

        $stmt = Connection::connect()->prepare("SELECT * FROM $tabla");

        $stmt -> execute();

        return $stmt -> fetchAll();

    }

        // return $stmt -> fetchAll();    
    
        // $stmt -> close();
         
         $stmt = null;
    }
 /*========================================
  =        Registro de usuario      =
  =============================================*/

  static public function mdlUserLogin($tabla, $data){

    $stmt = Connection::connect()->prepare(
                    "INSERT INTO $tabla (nombre, usuario, password, perfil, foto ) 
                    VALUES (:nombre, :usuario, :password, :perfil, :foto )");

    $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $data["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
    $stmt->bindParam(":perfil", $data["perfil"], PDO::PARAM_STR);
    $stmt->bindParam(":foto", $data["foto"], PDO::PARAM_STR);
  

    if($stmt->execute()){

        return "ok";	

    }else{

        return "error";
    
    }
    
    $stmt = null;

    }

    /*========================================
  =        editar Usuario      =
  =============================================*/
    public static function mdlEditUser($tabla, $data){

        $stmt = Connection::connect()->prepare("UPDATE $tabla SET nombre = :nombre, password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
            // enlazamos paramet5ros.
            $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
            $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
            $stmt->bindParam(":perfil", $data["perfil"], PDO::PARAM_STR);
            $stmt->bindParam(":foto", $data["foto"], PDO::PARAM_STR);
            $stmt->bindParam(":usuario", $data["usuario"], PDO::PARAM_STR);

            if($stmt->execute()){

                return "ok";	
    
            }else{
    
                return "error";
            
            }
    
            $stmt->close();
            
            $stmt = null;

    }
}
