<?php

require_once "connection.php";

class ModelCategories{

        /*========================================
        =        Agregar Categoria.     =
        =============================================*/


    static public function mdlCreateCategories($tabla, $value){

        $stmt = Connection::connect()->prepare("INSERT INTO $tabla (nombre_cat) VALUES (:nombre_cat)");

        $stmt->bindParam(":nombre_cat", $value, PDO::PARAM_STR);

        var_dump($tabla);
        
		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		//  $stmt-> close();
		$stmt = null;

    }

    /*========================================
        =        Mostrar  Categoria.     =
        =============================================*/

    static public function mdlShowCategories($tabla, $item, $valor){

        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}

		// $stmt -> close();

		$stmt = null;

    }
}