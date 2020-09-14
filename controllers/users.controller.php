<?php
/**
 * 
 */
class ControllersUsers{
    /*========================================
  =         Ingreso al sistema       =
  =============================================*/

  public function ctrUserLogin(){
    if(isset($_POST["ingUsuario"])){

      if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

          $table = "users";

          $item = "user";
          $value = $_POST["ingUsuario"];

          $reply = ModelsUsers::Mdlshowusers($table, $item, $value);

          if($reply["user"] == $_POST["ingUsuario"] && $reply["password"] == $_POST["ingPassword"]){
            
            $_SESSION["login"] = "ok";

            echo '<script>
            windows.location = "inicio
            
            </script>';
            /*echo '<br><div class="alert alert-success">Bienvenido al Sistema</div>';*/

          }else{
            echo '<br><div class="alert alert-danger">Error al ingresar, usuario incorrecto</div>';
          }
      }

    }
  }
}