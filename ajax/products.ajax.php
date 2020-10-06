<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

// require_once "../controllers/categoria.controller.php";
// require_once "../models/categoria.model.php";


class AjaxProducts{

    /*========================================
      =  Asignar codigo a partir del existente para cada categoria.. =
      =============================================*/

      public $idCategoria;

    public function ajaxCreateProductCode(){

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControllerProducts::ctrShowProducts($item, $valor);

        echo json_encode($respuesta);

    }
}
        /*========================================
      =  Generar el codigo apartir de una categoria.. =
      =============================================*/

      if(isset($_POST["idCategoria"])){

        $codigoProducto = new AjaxProducts();
        $codigoProducto -> idCategoria = $_POST["idCategoria"];
        $codigoProducto -> ajaxCreateProductCode();
      
      }