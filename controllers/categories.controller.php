<?php

class ControllerCategories{
        
        /*========================================
        =        Agregar Categorias.      =
        =============================================*/

    static public function ctrCreateCategories(){

        if(isset($_POST["nuevaCategoria"])){

            if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaCategoria"])){
                  
                $tabla = "categorias";

                $value = $_POST["nuevaCategoria"];

                $reply = ModelCategories::mdlCreateCategories($tabla, $value);
                var_dump($reply);
                if($reply == "ok"){

                    echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido guardada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
                }

            }else{
                echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';
            }
        }
    }

		/*========================================
        =        Mostrar Categorias.      =
        =============================================*/

	static public function ctrShowCategories($item, $valor){
		
		$tabla = "categorias";

		$reply = ModelCategories::mdlShowCategories($tabla, $item, $valor);

		return $reply;

	}

		/*========================================
        =        Editar  Categorias.      =
		=============================================*/
	
	static public function ctrEditCategories(){
		
		if(isset($_POST["editarCategoria"])){

			if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarCategoria"])){

				$tabla = "categorias";

				$datos = array("nombre_cat"=>$_POST["editarCategoria"],
							   "id"=>$_POST["idCategoria"]);

				$respuesta = ModelCategories::mdlEditCategories($tabla, $datos);

				if($respuesta == "ok"){

					echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido cambiada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';

				}


			}else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡La categoría no puede ir vacía o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "categorias";

							}
						})

			  	</script>';

			}

		}


	}

		/*========================================
        =        Borrar Categorias.      =
		=============================================*/
	static public function ctrDeleteCategories(){
		
		if(isset($_GET["idCategoria"])){

			$tabla ="Categorias";
			$datos = $_GET["idCategoria"];

			$resply = ModelCategories::mdlDeleteCategories($tabla, $datos);

			if($resply == "ok"){

				echo'<script>

					swal({
						  type: "success",
						  title: "La categoría ha sido borrada correctamente",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
									if (result.value) {

									window.location = "categorias";

									}
								})

					</script>';
			}
		}
		
	}
}