<?php
require_once "../controllers/categories.controller.php";
require_once "../models/categories.model.php";

class AjaxCategories{


    public $idCategoria;

    /*=============================================
	Editarcategoria.
	=============================================*/	

    public function ajaxEditCategories(){

        $item = "id";
		$valor = $this->idCategoria;

		$respuesta = ControllerCategories::ctrShowCategories($item, $valor);

		echo json_encode($respuesta);
    }


}
/*=============================================
	Editarcategoria.
    =============================================*/	
    
if(isset($_POST["idCategoria"])){

	$categoria = new AjaxCategories();
	$categoria -> idCategoria = $_POST["idCategoria"];
	$categoria -> ajaxEditCategories();
}