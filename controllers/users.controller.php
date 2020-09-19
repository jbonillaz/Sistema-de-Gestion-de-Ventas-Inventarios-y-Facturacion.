<?php
/**
 * 
 */
class ControllersUsers{
    /*========================================
  =      Ingreso al sistema       =
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
            $_SESSION["usuario"] = $reply["usuario"];
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
  }//termino del metodo
 /*========================================
  =     Registro de usuario      =
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
  } //termino del metodo
    /*=============================================
         Mostar usuarios
    =============================================*/
  static public function ctrshowusers($item, $value){

                      $tabla = "usuarios";

                      $reply = ModelsUsers::Mdlshowusers($tabla, $item, $value);

                      return $reply;
  }//termino del metodo
    /*=============================================
         Editar usuario
      =============================================*/
  public function CtrEditUser(){

          if(isset($_POST["editarUsuario"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"])){

              /*=============================================
              Validar foto
              =============================================*/

              $ruta = $_POST["fotoActual"];

              if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"])){

                list($ancho, $alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);

                $nuevoAncho = 500;

                $nuevoAlto = 500;
                
                /*=============================================
                Creamos el directorio donde vamos a guardar la foto del usuario.
                =============================================*/
                $directorio = "views/img/users/".$_POST["editarUsuario"];
                /*=============================================
                Preguntamos si existe la foto en la BD.
                =============================================*/
                if(!empty($_POST["fotoActual"])){

                  unlink($_POST["fotoActual"]);

                }else{

                  mkdir($directorio, 0755);
                }	

                /*=============================================
                Validacion de la imagen que sea JPEG
                =============================================*/

                if($_FILES["editarFoto"]["type"] == "image/jpeg"){

                  /*=============================================
                  Guardamos la imagen en el directorio.
                  =============================================*/
      
                  $aleatorio = mt_rand(100,999);
      
                  $ruta = "views/img/users/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
      
                  $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);						
      
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
      
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
      
                  imagejpeg($destino, $ruta);
                }

                if($_FILES["editarFoto"]["type"] == "image/png"){

                  /*=============================================
                  Guardamos la imagen en el directorio.
                  =============================================*/
      
                  $aleatorio = mt_rand(100,999);
      
                  $ruta = "views/img/users/".$_POST["editarUsuario"]."/".$aleatorio.".png";
      
                  $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);						
      
                  $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
      
                  imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
      
                  imagepng($destino, $ruta);
                }
              }

              $tabla = "usuarios";

				      if($_POST["editarPassword"] != ""){

                if(preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])){

                  $encriptar = crypt($_POST["editarPassword"], '$2a$07$asxx54ahjppf45sd87a5a4dDDGsystemdev$');

                }else{

                  echo'<script>

                  swal({
                      type: "error",
                      title: "¡La contraseña no puede ir vacía o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                      if (result.value) {
  
                      window.location = "usuarios";
  
                      }
                    })
  
                  </script>';
                }

              }else{

                $encriptar = $_POST["passwordActual"];

              }

              $data = array("nombre" => $_POST["editarNombre"],
                                          "usuario" => $_POST["editarUsuario"],
                                          "password" => $encriptar,
                                          "perfil" => $_POST["editarPerfil"],
                                          "foto"=>$ruta);

              $reply = ModelsUsers::mdlEditUser($tabla, $data);
              if($reply == "ok"){

                echo'<script>
      
                swal({
                    type: "success",
                    title: "El usuario ha sido editado correctamente",
                    showConfirmButton: true,
                    confirmButtonText: "Cerrar"
                    }).then(function(result){
                        if (result.value) {
      
                        window.location = "usuarios";
      
                        }
                      })
      
                </script>';
      
              }

            }else{
                  echo'<script>

              swal({
                  type: "error",
                  title: "¡El nombre no puede ir vacío o llevar caracteres especiales!",
                  showConfirmButton: true,
                  confirmButtonText: "Cerrar"
                  }).then(function(result){
                  if (result.value) {

                  window.location = "usuarios";

                  }
                })

              </script>';
            }
          }
 } //termino del metodo
}//termino de la clase