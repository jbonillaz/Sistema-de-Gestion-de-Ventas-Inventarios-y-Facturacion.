<?php


class ModelProducts{

        /*========================================
        =        Mostar productos..     =
        =============================================*/

    static public function mdlShowProducts($tabla, $item, $valor){


        if($item != null){

            $stmt = Connection::connect()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER BY id DESC");

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