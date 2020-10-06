<?php
/**
 * 
 */

class ControllerProducts{


        /*========================================
        =        Mostrar Productos.      =
        =============================================*/

        static public function ctrShowProducts($item, $valor){

                $tabla = "productos";

                $reply = ModelProducts::mdlShowProducts($tabla, $item, $valor);

                return $reply;

        }

         /*========================================
        =        Crear productos.      =
        =============================================*/

        static public function ctrCreateProduct(){

                if(isset($_POST["nuevaDescripcion"])){

                        if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevaDescripcion"]) &&
			   preg_match('/^[0-9]+$/', $_POST["nuevoStock"]) &&	
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioCompra"]) &&
			   preg_match('/^[0-9.]+$/', $_POST["nuevoPrecioVenta"])){

                                $ruta = "views/img/products/Bouquet_de_globos";

                                $tabla = "productos";

				$datos = array("id_categoria" => $_POST["nuevaCategoria"],
						"codigo" => $_POST["nuevoCodigo"],
						"descripcion" => $_POST["nuevaDescripcion"],
						"stock" => $_POST["nuevoStock"],
						"precio_compra" => $_POST["nuevoPrecioCompra"],
						"precio_venta" => $_POST["nuevoPrecioVenta"],
						"imagen" => $ruta);


                                $reply = ModelProducts::mdlEnterProducts($tabla, $datos);

                                if($reply == "ok"){

                                        echo'<script>

						swal({
							  type: "success",
							  title: "El producto ha sido guardado correctamente",
							  showConfirmButton: true,
							  confirmButtonText: "Cerrar"
							  }).then(function(result){
										if (result.value) {

										window.location = "productos";

										}
									})

						</script>';
                                }


                        }else{

				echo'<script>

					swal({
						  type: "error",
						  title: "¡El producto no puede ir con los campos vacíos o llevar caracteres especiales!",
						  showConfirmButton: true,
						  confirmButtonText: "Cerrar"
						  }).then(function(result){
							if (result.value) {

							window.location = "productos";

							}
						})

			  	</script>';
			}
                }


        }

}