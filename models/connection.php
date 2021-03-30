<?php

class  Connection{

    static  public function connect(){

         $link = new PDO("mysql:host=localhost;dbname=llanosoft-licorera",
                         "root",
                          "");

        /**Evaluar la coneccion */
        $link->exec("set names utf8");

        return $link;

    }
    
}