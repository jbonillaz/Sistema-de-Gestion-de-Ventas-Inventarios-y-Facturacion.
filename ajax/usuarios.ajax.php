<?php
require_once "../controllers/users.controller.php";
require_once "../models/users.model.php";

class AjaxUsuarios{

/*=============================================
	Editar usuarios
	=============================================*/	
    public $idUsuario;

    public function ajaxEditarUsuario(){

        $item = "id";
        $valor = $this->idUsuario;

        $reply = ControllersUsers::ctrshowusers($item, $valor);
            echo json_encode($reply);
    }


}

/*=============================================
	Editar usuarios
    =============================================*/

if(isset($_POST["idUsuario"])){

    $editar = new AjaxUsuarios();
    $editar -> idUsuario = $_POST["idUsuario"];
    $editar -> ajaxEditarUsuario();

}