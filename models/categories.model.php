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
	
	/*========================================
        =        Editar  Categoria.     =
        =============================================*/


    static public function mdlEditCategories($tabla, $datos){
       
        $stmt = Connection::connect()->prepare("UPDATE $tabla SET nombre_cat = :nombre_cat WHERE id = :id");

		$stmt -> bindParam(":nombre_cat", $datos["nombre_cat"], PDO::PARAM_STR);
		$stmt -> bindParam(":id", $datos["id"], PDO::PARAM_INT);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		// $stmt->close();
		$stmt = null;

	}
	
	/*========================================
        =        Borrar  Categoria.     =
		=============================================*/
	static public function mdlDeleteCategories($tabla, $datos){
		
		$stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id = :id");

		$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}

		// $stmt -> close();

		$stmt = null;
	}
}