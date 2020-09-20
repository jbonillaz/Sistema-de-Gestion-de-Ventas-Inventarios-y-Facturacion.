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
    /*=============================================
	Activar Usuarios.
    =============================================*/

    public $activarUsuario;
	public $activarId;

    public function ajaxActivarUsuario(){

        $tabla = "usuarios";

		$item1 = "estado";
		$valor1 = $this->activarUsuario;

		$item2 = "id";
		$valor2 = $this->activarId;

		$respuesta = ModelsUsers::mdlUpdateUser($tabla, $item1, $valor1, $item2, $valor2);

    }

    /*=============================================
    Validacion de usuario, si ya se encuentra registrado.
    =============================================*/

    public $validarUsuario;

	public function ajaxValidarUsuario(){

		$item = "usuario";
		$valor = $this->validarUsuario;

		$respuesta = ControllersUsers::ctrshowusers($item, $valor);

		echo json_encode($respuesta);

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
    /*=============================================
	Activar Usuario.
    =============================================*/
if(isset($_POST["activarUsuario"])){

	$activarUsuario = new AjaxUsuarios();
	$activarUsuario -> activarUsuario = $_POST["activarUsuario"];
	$activarUsuario -> activarId = $_POST["activarId"];
	$activarUsuario -> ajaxActivarUsuario();

}
    /*=============================================
	Validar usuario.
    =============================================*/

if(isset( $_POST["validarUsuario"])){

	$valUsuario = new AjaxUsuarios();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();

}