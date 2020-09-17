<?php
/**
 * 
 */
class ControllersUsers{
    /*========================================
  =         Ingreso al sistema       =
  =============================================*/

  static public function ctrUserLogin(){

    if(isset($_POST["ingUsuario"])){

      if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingUsuario"]) &&
			   preg_match('/^[a-zA-Z0-9]+$/', $_POST["ingPassword"])){

          $tabla = "usuarios";

          $item = "usuario";
          $value = $_POST["ingUsuario"];

          $reply = ModelsUsers::Mdlshowusers($tabla, $item, $value);

          if($reply["usuario"] == $_POST["ingUsuario"] && $reply["password"] == $_POST["ingPassword"]){
            
            $_SESSION["login"] = "ok";

            echo '<script>
            windows.location = "inicio";
            
            </script>';
            /*echo '<br><div class="alert alert-success">Bienvenido al Sistema</div>';*/

          }else{
            echo '<br><div class="alert alert-danger">Error al ingresar, usuario incorrecto</div>';
          }
      }

    }
  }
 /*========================================
  =        Registro de usuario      =
  =============================================*/
static public function ctrCreateUser(){

    if(isset($_POST["nuevoUsuario"])){

      if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoUsuario"]) &&
        preg_match('/^[a-zA-Z0-9]+$/', $_POST["nuevoPassword"])){


          $tabla ="usuarios";

          $data = array("nombre" => $_POST["nuevoNombre"],
                        "usuario" => $_POST["nuevoUsuario"],
                        "password" => $_POST["nuevoPassword"],
                        "perfil" => $_POST["nuevoPerfil"]);

         $reply = ModelsUsers::mdlUserLogin($tabla, $data);

        //  var_dump($reply);

        //  return;

                if($reply == "ok"){

                  echo '<script>

                  swal({

                    type: "success",
                    title: "¡El usuario ha sido guardado correctamente!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                  }).then(function(result){

                    if(result.value){
                    
                      window.location = "usuarios";

                    }

                  });
                

                  </script>';


                }	


              }else{

                echo '<script>

                  swal({

                    type: "error",
                    title: "¡El usuario no puede ir vacío o llevar caracteres especiales!",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"

                  }).then(function(result){

                    if(result.value){
                    
                      window.location = "usuarios";

                    }

                  });
                

                </script>';

              }

            }
       } 
}