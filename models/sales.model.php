<?php


class SalesModel{

        /*========================================
        =        Mostrar Productos.      =
        =============================================*/
    static public function mdlShowSales($tabla, $item, $valor){

        if($item != null){

			$stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id ASC");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Connection::connect()->prepare("SELECT * FROM $tabla ORDER BY id ASC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		
		// $stmt -> close();

		$stmt = null;


        
    }

}