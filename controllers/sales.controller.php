<?php
/**
 * 
 */

class SalesController{

        /*========================================
        =        Mostrar Ventas.      =
        =============================================*/
    static public function ctrShowSales($item, $valor){

        $tabla = "ventas";

        $respuesta = SalesModel::mdlShowSales($tabla, $item, $valor);

        return $respuesta;
    }
}
