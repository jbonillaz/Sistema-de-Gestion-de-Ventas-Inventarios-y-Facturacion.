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
      /*========================================
      =  Editar producto... =
      =============================================*/

    public $idProducto;
    public $traerProductos;
    public $nombreProducto;

    public function ajaxEditProduct(){

      if($this->traerProductos == "ok"){

        $item = null;
        $valor = null;

        $respuesta = ControllerProducts::ctrShowProducts($item, $valor);

        echo json_encode($respuesta);

      }else if($this->nombreProducto != ""){

        $item = "descripcion";
        $valor = $this->nombreProducto;

        $respuesta = ControllerProducts::ctrShowProducts($item, $valor);

        echo json_encode($respuesta);

      }else{

      $item = "id";
      $valor = $this->idProducto;

      $respuesta = ControllerProducts::ctrShowProducts($item, $valor);

      echo json_encode($respuesta);

      }
    }
 }
        /*========================================
      =  Objeto, Generar el codigo apartir de una categoria.. =
      =============================================*/

      if(isset($_POST["idCategoria"])){

        $codigoProducto = new AjaxProducts();
        $codigoProducto -> idCategoria = $_POST["idCategoria"];
        $codigoProducto -> ajaxCreateProductCode();
      
      }

       /*========================================
      =  Objeto, Editar producto.. =
      =============================================*/

      if(isset($_POST["idProducto"])){

        $editarProducto = new AjaxProducts();
        $editarProducto -> idProducto = $_POST["idProducto"];
        $editarProducto -> ajaxEditProduct();
      
      }

       /*========================================
      =  Traer productos desde dispositivos moviles. =
      =============================================*/

      if(isset($_POST["traerProductos"])){

        $traerProductos = new AjaxProducts();
        $traerProductos -> traerProductos = $_POST["traerProductos"];
        $traerProductos -> ajaxEditProduct();
      
      }
       /*========================================
      =  Traer productos. =
      =============================================*/

      if(isset($_POST["nombreProducto"])){

        $traerProductos = new AjaxProducts();
        $traerProductos -> nombreProducto = $_POST["nombreProducto"];
        $traerProductos -> ajaxEditProduct();
      
      }