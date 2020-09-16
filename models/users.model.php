<?php

require_once "connection.php";

class ModelsUsers{
    /**Mostrar usuarios */

    static public function Mdlshowusers($table, $item, $value){

        // if($item != null){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
        
        $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
        
        $stmt -> execute();

        return $stmt -> fetch();

    /*}else{

        $stmt = Connection::connect()->prepare("SELECT * FROM $table");

        $stmt -> execute();

    }*/

        // return $stmt -> fetchAll();    
    
        //  $stmt -> close();
         
         $stmt = null;
    }
 /*========================================
  =        Registro de usuario      =
  =============================================*/

  static public function mdlUserLogin($table, $data){

    $stmt = Connection::connect()->prepare(
                    "INSERT INTO $table (nombre, usuario, password, perfil ) 
                    VALUES (:nombre, :usuario, :password, :perfil )");

    $stmt->bindParam(":nombre", $data["nombre"], PDO::PARAM_STR);
    $stmt->bindParam(":usuario", $data["usuario"], PDO::PARAM_STR);
    $stmt->bindParam(":password", $data["password"], PDO::PARAM_STR);
    $stmt->bindParam(":perfil", $data["perfil"], PDO::PARAM_STR);
    // $stmt->bindParam(":foto", $data["photo"], PDO::PARAM_STR);
  

    if($stmt->execute()){

        return "ok";	

    }else{

        return "error";
    
    }

    // $stmt->close();
    
    $stmt = null;

    }


}
