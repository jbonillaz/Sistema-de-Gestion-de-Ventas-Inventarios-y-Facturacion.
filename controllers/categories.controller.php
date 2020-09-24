<?php

class ControllerCategories{
        
        /*========================================
        =        Agregar Categoria.      =
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
        =        Agregar Categoria.      =
        =============================================*/

	static public function ctrShowCategories($item, $valor){
		
		$tabla = "categorias";

		$reply = ModelCategories::mdlShowCategories($tabla, $item, $valor);

		return $reply;

	}

}