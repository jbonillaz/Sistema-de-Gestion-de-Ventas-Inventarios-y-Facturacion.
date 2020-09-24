<?php

require_once "connection.php";

class ModelCategories{

        /*========================================
        =        Agregar Categoria.     =
        =============================================*/


    static public function mdlCreateCategories($tabla, $value){

        $stmt = Connection::connect()->prepare("INSERT INTO $tabla (nombre) VALUES (:nombre)");

        $stmt->bindParam(":nombre", $value, PDO::PARAM_STR);

        var_dump($tabla);
        
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//  $stmt-> close();
		$stmt = null;

    }
}