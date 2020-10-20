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

                    // /*========================================
                    // =Verificar si vienen productos editados=
                    // =============================================*/

                    if($_POST["listaProductos"] == ""){

                        $listaProductos = $traerVenta["productos"];
                        $cambioProducto = false;
                    }else{

                        $listaProductos = $_POST["listaProductos"];
				        $cambioProducto = true;
                    }
                    
                    if($cambioProducto){

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
        
                        $listaProductos_2 = json_decode($listaProductos, true);
        
                        // var_dump($listaProductos);
        
                        $totalProductosComprados_2 = array();
        
                        foreach ($listaProductos_2 as $key => $value){
        
                            array_push($totalProductosComprados_2, $value["cantidad"]);
        
                            $tablaProductos_2 = "productos";
        
                            $item_2 = "id";
                            $valor_2 = $value["id"];
                            
                            $traerProducto_2 = ModelProducts::mdlShowProducts($tablaProductos_2, $item_2, $valor_2);
        
                            // var_dump($traerProducto["ventas"]);
                            $item1a_2 = "ventas";
                            $valor1a_2 = $value["cantidad"] + $traerProducto_2["ventas"];
        
                            $nuevasVentas_2 = ModelProducts::mdlUpdateProduct($tablaProductos_2, $item1a_2, $valor1a_2, $valor_2);
        
                            $item1b_2 = "stock";
                            $valor1b_2 = $traerProducto_2["stock"] - $value["cantidad"];

                            $nuevoStock_2 = ModelProducts::mdlUpdateProduct($tablaProductos_2, $item1b_2, $valor1b_2, $valor_2);
        
                        }
        
                        $tablaClientes_2 = "clientes";
        
                        $item_2 = "id";
                        $valor_2b = $_POST["seleccionarCliente"];
                        
                        $traerCliente_2 = ModelClient::mdlShowClient($tablaClientes_2, $item_2, $valor_2b);
                        // var_dump($traerCliente);
        
                        $item1a_2 = "compras";
                        $valor1a_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
        
                        $comprasCliente_2 = ModelClient::mdlUpdateClient($tablaClientes_2, $item1a_2, $valor1a_2, $valor_2b);
        
        
                        $item1b_2 = "ultima_compra";
                        
                        date_default_timezone_set('America/Bogota');
        
                        $fecha = date('Y-m-d');
                        $hora = date('H:i:s');
                        $valor_2 = $fecha.' '.$hora;
        
                        $fechaCliente_2 = ModelClient::mdlUpdateClient($tablaClientes_2, $item1b_2, $valor1b_2, $valor_2b);
                    }
                    // /*========================================
                    // =        Guardar cambios de la venta.      =
                    // =============================================*/
    
                    $tabla = "ventas";
    
                    $datos = array("id_vendedor"=>$_POST["idVendedor"],
                               "id_cliente"=>$_POST["seleccionarCliente"],
                               "codigo"=>$_POST["editarVenta"],
                               "productos"=>$listaProductos,
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

        /*========================================
        =        Eliminar ventas     =
        =============================================*/

    static public function ctrDeleteSale(){

        if(isset($_GET["idVenta"])){

            $tabla = "ventas";

			$item = "id";
            $valor = $_GET["idVenta"];
            
            $traerVenta = SalesModel::mdlShowSales($tabla, $item, $valor);

                    /*=============================================
                    Actualizar la fecha de la ultima compra.
                    =============================================*/
                
                    $tablaClientes = "clientes";

                    $itemVentas = null;
                    $valorVentas = null;

                    $traerVentas = SalesModel::mdlShowSales($tabla, $itemVentas, $valorVentas);

                    $guardarFechas = array();
                    
                    foreach ($traerVentas as $key => $value) {

                        if($value["id_cliente"] == $traerVenta["id_cliente"]){

                            array_push($guardarFechas, $value["fecha"]);

                        }

                       
                    }

                    // var_dump($guardarFechas);
                    if(count($guardarFechas) > 1){
                        
                        if($traerVenta["fecha"] > $guardarFechas[count($guardarFechas)-2]){

                            $item = "ultima_compra";
					        $valor = $guardarFechas[count($guardarFechas)-2];
                            $valorIdCliente = $traerVenta["id_cliente"];
                            
                            $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item, $valor, $valorIdCliente);

                        }else{

                            $item = "ultima_compra";
					        $valor = $guardarFechas[count($guardarFechas)-1];
                            $valorIdCliente = $traerVenta["id_cliente"];
                            
                            $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item, $valor, $valorIdCliente);

                        }

                    }else{

                        $item = "ultima_compra";
				        $valor = "0000-00-00 00:00:00";
                        $valorIdCliente = $traerVenta["id_cliente"];
                        
                        $compraClientes = ModelClient::mdlUpdateClient($tablaClientes, $item, $valor, $valorIdCliente);


                    }

                    /*=============================================
                    Formatear la tabla de productos y de clientes.
                    =============================================*/  

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
                        $valorCliente = $traerVenta["id_cliente"];
                        
                        $traerCliente = ModelClient::mdlShowClient($tablaClientes, $itemCliente, $valorCliente);

                        $item1a = "compras";
                        $valor1a = $traerCliente["compras"] - array_sum($totalProductosComprados);
        
                        $comprasCliente = ModelClient::mdlUpdateClient($tablaClientes, $item1a, $valor1a, $valorCliente);


                    /*=============================================
                    Eliminar la venta.
                    =============================================*/

                    $respuesta = SalesModel::mdlDeleteSale($tabla, $_GET["idVenta"]);

                    if($respuesta == "ok"){

                        echo'<script>
        
                        swal({
                              type: "success",
                              title: "La venta ha sido borrada correctamente",
                              showConfirmButton: true,
                              confirmButtonText: "Cerrar",
                              closeOnConfirm: false
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