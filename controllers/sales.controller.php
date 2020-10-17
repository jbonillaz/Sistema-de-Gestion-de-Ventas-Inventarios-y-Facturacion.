<?php
/**
 * 
 */

class SalesController{

        /*========================================
        =        Mostrar Ventas.      =
        =============================================*/
    static public function ctrShowSales($item, $valor){

        $tabla = "ventas";

        $respuesta = SalesModel::mdlShowSales($tabla, $item, $valor);

        return $respuesta;
    }

        /*========================================
        =        Crear una venta.      =
        =============================================*/

    static public function ctrCreateSale(){

        if(isset($_POST["nuevaVenta"])){

                /*========================================
                = Aumentar las compras del cliente, reducir el stock y aumentas de los productos.      =
                =============================================*/

                $listaProductos = json_decode($_POST["listaProductos"], true);

                // var_dump($listaProductos);

                $totalProductosComprados = array();

                foreach ($listaProductos as $key => $value){

                    array_push($totalProductosComprados, $value["cantidad"]);

                    $tablaProductos = "productos";

                    $item = "id";
                    $valor = $value["id"];
                    
                    $traerProducto = ModelProducts::mdlShowProducts($tablaProductos, $item, $valor);

                    // var_dump($traerProducto["ventas"]);
                    $item1a = "ventas";

                    $valor1a = $value["cantidad"] + $traerProducto["ventas"];
                    

                    $nuevasVentas = ModelProducts::mdlUpdateProduct($tablaProductos, $item1a, $valor1a, $valor);

                    $item1b = "stock";
                    $valor1b = $value["stock"];
                    
                    $nuevoStock = ModelProducts::mdlUpdateProduct($tablaProductos, $item1b, $valor1b, $valor);

                }

                $tablaClientes = "clientes";

                $item = "id";
                $valor = $_POST["seleccionarCliente"];
                
                $traerCliente = ModelClient::mdlShowClient($tablaClientes, $item, $valor);
                // var_dump($traerCliente);

                $item1 = "compras";
                $valor1 = array_sum($totalProductosComprados) + $traerCliente["compras"];

                $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item1, $valor1, $valor);

                /*========================================
                =        Guardar la venta.      =
                =============================================*/

                $tabla = "ventas";

                $datos = array("id_vendedor"=>$_POST["idVendedor"],
						   "id_cliente"=>$_POST["seleccionarCliente"],
						   "codigo"=>$_POST["nuevaVenta"],
						   "productos"=>$_POST["listaProductos"],
						   "impuesto"=>$_POST["nuevoPrecioImpuesto"],
						   "neto"=>$_POST["nuevoPrecioNeto"],
						   "total"=>$_POST["totalVenta"],
                           "metodo_pago"=>$_POST["listaMetodoPago"]);
                           
                $respuesta = SalesModel::mdlEnterSale($tabla, $datos);

                if($respuesta == "ok"){

                    echo'<script>
    
                    localStorage.removeItem("rango");
    
                    swal({
                          type: "success",
                          title: "La venta ha sido guardada correctamente",
                          showConfirmButton: true,
                          confirmButtonText: "Cerrar"
                          }).then((result) => {
                                    if (result.value) {
    
                                    window.location = "ventas";
    
                                    }
                                })
    
                    </script>';
    
                }
            }           
    }
}
