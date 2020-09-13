<?php

require_once "connection.php";

class ModelsUsers{
    /**Mostrar usuarios */

    static public function Mdlshowusers($table, $item, $value){

        $stmt = Connection::connect()->prepare("SELECT * FROM $table WHERE $item = :$item");
        $stmt -> bindParam(":".$item, $value, PDO::PARAM_STR);
        $stmt -> execute();

        return $stmt -> fetch();
    }
}
