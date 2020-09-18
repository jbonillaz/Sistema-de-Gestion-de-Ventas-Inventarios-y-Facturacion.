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

          $encriptar = crypt($_POST["ingPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $tabla = "usuarios";

          $item = "usuario";
          $value = $_POST["ingUsuario"];

          $reply = ModelsUsers::Mdlshowusers($tabla, $item, $value);

          if($reply["usuario"] == $_POST["ingUsuario"] && $reply["password"] == $encriptar){
            
            $_SESSION["login"] = "ok";
            $_SESSION["id"] = $reply["id"];
            $_SESSION["nombre"] = $reply["nombre"];
            $_SESSION["usuario"] = $reply["usuairo"];
            $_SESSION["foto"] = $reply["foto"];
            $_SESSION["perfil"] = $reply["perfil"];

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

/*========================================
  =        Validar imagen      =
  =============================================*/
  $ruta = "";

  if(isset($_FILES["nuevaFoto"]["tmp_name"])){

    list($ancho, $alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
    // var_dump(getimagesize($_FILES["nuevaFoto"]["tmp_name"]));
    $nuevoAncho = 500;
    $nuevoAlto = 500;

    /*========================================
  =        Creacion del directorio donde se 
        guarda la foto del usuario     =
  =============================================*/

  $directorio = "views/img/users/".$_POST["nuevoUsuario"];
// 0705 son los permisos de lectura y escritura
					mkdir($directorio, 0755);

/*=============================================
          de acuerdo a ltipo de imagen se colocan
           las funciones poor defecto de PHP
					=============================================*/
          if($_FILES["nuevaFoto"]["type"] == "image/jpeg"){

           /*=============================================
          Guardamos la imagen en el directrorio.
          =============================================*/
          $aleatorio = mt_rand(100,999);

						$ruta = "views/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
            // cortando la imagen,
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);						
              // para que mantenga las mimas propiedades
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
            // ajustar la imagen al tamaño de 500x500
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
            // Guardar la imagen en la ruta que le estamos asignando
						imagejpeg($destino, $ruta);
          

          }
          if($_FILES["nuevaFoto"]["type"] == "image/png"){

            /*=============================================
           Guardamos la imagen en el directrorio.
           =============================================*/
           $aleatorio = mt_rand(100,999);
 
             $ruta = "views/img/users/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
             // cortando la imagen,
             $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);						
               // para que mantenga las mimas propiedades
             $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
             // ajustar la imagen al tamaño de 500x500
             imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
             // Guardar la imagen en la ruta que le estamos asignando
             imagepng($destino, $ruta);
           
 
           }
  }
  
          $tabla ="usuarios";
          $encriptar = crypt($_POST["nuevoPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

          $data = array("nombre" => $_POST["nuevoNombre"],
                        "usuario" => $_POST["nuevoUsuario"],
                        "password" => $encriptar,
                        "perfil" => $_POST["nuevoPerfil"],
                        "foto"=>$ruta);

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