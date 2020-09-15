<?php

class  Connection{

    static  public function connect(){

        $link = new PDO("mysql:host=localhost;dbname=pos_liroz",
                         "root",
                          "");

        /**Evaluar la coneccion */
        $link->exec("set names utf8");

        return $link;

    }
    
}