<?php

require_once "../controllers/clients.controller.php";
require_once "../models/clients.model.php";

class AjaxClients{
        /*========================================
        =  Editar Clientes =
        =============================================*/
    public $idCliente;

    public function ajaxEditClient(){

        $item = "id";
        $valor = $this->idCliente;
        
        $respuesta = ControllerClient::ctrShowClient($item, $valor);

        echo json_encode($respuesta);

    }

}

        /*========================================
        =  Objeto Editar Clientes =
        =============================================*/

if(isset($_POST["idCliente"])){

    $cliente = new AjaxClients();
    $cliente -> idCliente = $_POST["idCliente"];
    $cliente -> ajaxEditClient();
        
}