<?php

require_once "../controllers/products.controller.php";
require_once "../models/products.model.php";

require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class ProductTable{

    /*========================================
  =  Mostrar la tabla de productos =
  =============================================*/

    public function ShowProductTable(){

      $item = null;
      $valor = null;
      $orden ="id";
      

  		$productos = ControllerProducts::ctrShowProducts($item, $valor, $orden);	

      

      $botones =  "<div class='btn-group'><button class='btn btn-warning'><i class='fa fa-pencil'></i></button><button class='btn btn-danger'><i class='fa fa-times'></i></button></div>";

        $datosJson = '{
          "data": [';
          for($i = 0; $i < count($productos); $i++){

            /*========================================
            =  Traemos la imagen =
            =============================================*/

            $imagen = "<img src='".$productos[$i]["imagen"]."' width='40px'>";

             /*========================================
            =  Traemos la categoria =
            =============================================*/

            $item = "id";
            $valor = $productos[$i]["id_categoria"];

            $reply = ControllerCategories::ctrShowCategories($item, $valor);

             /*========================================
            =  Stock =
            =============================================*/
            
            if($productos[$i]["stock"] <= 10){

              $stock = "<button class='btn btn-danger'>".$productos[$i]["stock"]."</button>";
    
            }else if($productos[$i]["stock"] > 11 && $productos[$i]["stock"] <= 15){
    
              $stock = "<button class='btn btn-warning'>".$productos[$i]["stock"]."</button>";
    
            }else{
    
              $stock = "<button class='btn btn-success'>".$productos[$i]["stock"]."</button>";
    
            }

             /*========================================
            =  Traemos las acciones =
            =============================================*/

            $botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["id"]."' data-toggle='modal' data-target='#modalEditarProducto'><i class='fa fa-pencil'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["id"]."' codigo='".$productos[$i]["codigo"]."' imagen='".$productos[$i]["imagen"]."'><i class='fa fa-times'></i></button></div>";



            $datosJson .= ' [
                  "'.($i+1).'",
                  "'.$imagen.'",
                  "'.$productos[$i]["codigo"].'",
                  "'.$productos[$i]["descripcion"].'",
                  "'.$reply["nombre_cat"].'",
                  "'.$stock.'",
                  "'.$productos[$i]["precio_compra"].'",
                  "'.$productos[$i]["precio_venta"].'",
                  "'.$productos[$i]["fecha"].'",
                  "'.$botones.'"
           ],';

          }
          $datosJson = substr($datosJson, 0, -1);
        $datosJson .= ']
        
      }';       

      echo $datosJson;

    }

}

/*========================================
  =  Activar la tabla de productos =
  =============================================*/

//   Ejecutando el objeto

  $activateProducts = new ProductTable();
  $activateProducts -> ShowProductTable();