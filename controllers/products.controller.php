<?php
/**
 * 
 */

class ControllerProducts{


        /*========================================
        =        Mostrar Productos.      =
        =============================================*/

     static public function ctrShowProducts($item, $valor){

        $tabla = "productos";

        $reply = ModelProducts::mdlShowProducts($tabla, $item, $valor);

        return $reply;

        }

}