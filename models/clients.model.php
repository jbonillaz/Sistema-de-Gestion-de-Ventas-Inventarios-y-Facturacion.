<?php

require_once "connection.php";

class ModelClient{

    /*========================================
        =        Agregar Cliente.      =
        =============================================*/
    
    static public function mdlCreateClient($tabla, $datos){

        $stmt = Connection::connect()->prepare("INSERT INTO $tabla(nombre, documento, email, telefono, direccion, fecha_nacimiento) VALUES (:nombre, :documento, :email, :telefono, :direccion, :fecha_nacimiento)");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";

		}else{

			return "error";
		
		}

		// $stmt->close();
		$stmt = null;

    }

    /*========================================
        =        Mostrar clientes en el sistema.      =
        =============================================*/

    static public function mdlShowClient($tabla, $item, $valor){

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
        =        Editar Cliente.      =
        =============================================*/
    
		static public function mdlEditClient($tabla, $datos){

			$stmt = Connection::connect()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento WHERE id = :id");
	
			$stmt->bindParam(":id", $datos["id"], PDO::PARAM_INT);
			$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
			$stmt->bindParam(":documento", $datos["documento"], PDO::PARAM_INT);
			$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
			$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
			$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
			$stmt->bindParam(":fecha_nacimiento", $datos["fecha_nacimiento"], PDO::PARAM_STR);
	
			if($stmt->execute()){
	
				return "ok";
	
			}else{
	
				return "error";
			
			}
	
			// $stmt->close();
			$stmt = null;
	
		}
	/*========================================
        =        Eliminar Cliente.      =
		=============================================*/
		
		static public function mdlDeleteClient($tabla, $datos){

			$stmt = Connection::connect()->prepare("DELETE FROM $tabla WHERE id = :id");

			$stmt -> bindParam(":id", $datos, PDO::PARAM_INT);

			if($stmt -> execute()){

				return "ok";
			
			}else{

				return "error";	

			}

			$stmt -> close();

			$stmt = null;
		}

			/*========================================
        =        Eliminar Cliente.      =
		=============================================*/

		static public function mdlUpdateClient($tabla, $item1, $valor1, $valor){
       
			$stmt = Connection::connect()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");
	
			$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
			$stmt -> bindParam(":id", $valor, PDO::PARAM_STR);
			
	
			if($stmt -> execute()){
	
				return "ok";
			
			}else{
	
				return "error";	
	
			}
	
			// $stmt -> close();
	
			$stmt = null;
		}
}
