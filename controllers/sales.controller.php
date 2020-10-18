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

                $item1a = "compras";
                $valor1a = array_sum($totalProductosComprados) + $traerCliente["compras"];

                $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item1a, $valor1a, $valor);


                $item1b = "ultima_compra";
                
                date_default_timezone_set('America/Bogota');

                $fecha = date('Y-m-d');
                $hora = date('H:i:s');
                $valor1b = $fecha.' '.$hora;

                $fechaCliente = ModelClient::mdlUpdateClient($tablaClientes, $item1b, $valor1b, $valor);

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

    /*========================================
        =        Editar una venta.      =
        =============================================*/

    static public function ctrEditSale(){

            if(isset($_POST["editarVenta"])){

                    /*========================================
                    =Formatear la tabla de productos y la tabla de clientes.=
                    =============================================*/
                    $tabla = "ventas";

                    $item = "codigo";
                    $valor = $_POST["editarVenta"];

                    $traerVenta = SalesModel::mdlShowSales($tabla, $item, $valor);

                    $productos =  json_decode($traerVenta["productos"], true);

                     $totalProductosComprados = array();

                    foreach ($productos as $key => $value) {

                        array_push($totalProductosComprados, $value["cantidad"]);

                        $tablaProductos = "productos";

                        $item = "id";
                        $valor = $value["id"];

                        $traerProducto = ModelProducts::mdlShowProducts($tablaProductos, $item, $valor);
                        
                        $item1a = "ventas";
    
                        $valor1a = $traerProducto["ventas"] - $value["cantidad"];
                        
                        $nuevasVentas = ModelProducts::mdlUpdateProduct($tablaProductos, $item1a, $valor1a, $valor);

                        $item1b = "stock";
                        $valor1b = $value["cantidad"]+$traerProducto["stock"];
                        
                        $nuevoStock = ModelProducts::mdlUpdateProduct($tablaProductos, $item1b, $valor1b, $valor);



                    }

                     $tablaClientes = "clientes";
    
                    $itemCliente = "id";
                    $valorCliente = $_POST["seleccionarCliente"];
                    
                    $traerCliente = ModelClient::mdlShowClient($tablaClientes, $itemCliente, $valorCliente);

                    $item1a = "compras";
                    $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
    
                    $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item1a, $valor1a, $valor);

                    
    
                    /*========================================
                    = Aumentar las compras del cliente, reducir el stock y aumentas de los productos.      =
                    =============================================*/
    
                    $listaProducto_2 = json_decode($_POST["listaProductos"], true);
    
                    // var_dump($listaProductos);
    
                    $totalProductosComprado_2 = array();
    
                    foreach ($listaProducto_2 as $key => $value){
    
                        array_push($totalProductosComprado_2, $value["cantidad"]);
    
                        $tablaProducto_2 = "productos";
    
                        $ite_2 = "id";
                        $valo_2 = $value["id"];
                        
                        $traerProduct_2 = ModelProducts::mdlShowProducts($tablaProductos, $ite_2, $valo_2);
    
                        // var_dump($traerProducto["ventas"]);
                        $item_2 = "ventas";
    
                        $valor_2 = $value["cantidad"] + $traerProduct_2["ventas"];
                        
    
                        $nuevasVenta_2 = ModelProducts::mdlUpdateProduct($tablaProductos, $item_2, $valor_2, $valo_2);
    
                        $item_2 = "stock";
                        $valor_2 = $value["stock"];
                        
                        $nuevoStoc_2 = ModelProducts::mdlUpdateProduct($tablaProductos, $item_2, $valor_2, $valo_2);
    
                    }
    
                    $tablaCliente_2 = "clientes";
    
                    $ite_2 = "id";
                    $valo_2 = $_POST["seleccionarCliente"];
                    
                    $traerClient_2 = ModelClient::mdlShowClient($tablaCliente_2, $ite_2, $valo_2);
                    // var_dump($traerCliente);
    
                    $item_2 = "compras";
                    $valor_2 = array_sum($totalProductosComprado_2) + $traerClient_2["compras"];
    
                    $comprasClient_2 = ModelClient::mdlUpdateClient($tablaCliente_2, $item_2, $valor_2, $valo_2);
    
    
                    $item_2 = "ultima_compra";
                    
                    date_default_timezone_set('America/Bogota');
    
                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');
                    $valor_2 = $fecha.' '.$hora;
    
                    $fechaClient_2 = ModelClient::mdlUpdateClient($tablaCliente_2, $item_2, $valor_2, $valo_2);
    
                    /*========================================
                    =        Guardar cambios de la venta.      =
                    =============================================*/
    
                    $tabla = "ventas";
    
                    $datos = array("id_vendedor"=>$_POST["idVendedor"],
                               "id_cliente"=>$_POST["seleccionarCliente"],
                               "codigo"=>$_POST["editarVenta"],
                               "productos"=>$_POST["listaProductos"],
                               "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                               "neto"=>$_POST["nuevoPrecioNeto"],
                               "total"=>$_POST["totalVenta"],
                               "metodo_pago"=>$_POST["listaMetodoPago"]);
                               
                    $respuesta = SalesModel::mdlEditSale($tabla, $datos);
    
                    if($respuesta == "ok"){
    
                        echo'<script>
        
                        localStorage.removeItem("rango");
        
                        swal({
                              type: "success",
                              title: "La venta ha sido actualizada o editada correctamente",
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
