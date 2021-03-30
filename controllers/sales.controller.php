<?php
use Mike42\Escpos\Printer;
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;

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
                    $orden ="id";
                    
                    $traerProducto = ModelProducts::mdlShowProducts($tablaProductos, $item, $valor, $orden);

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
                            $orden ="id";

                            $traerProducto = ModelProducts::mdlShowProducts($tablaProductos, $item, $valor, $orden);
                            
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
                            $orden = "id";
                            
                            $traerProducto_2 = ModelProducts::mdlShowProducts($tablaProductos_2, $item_2, $valor_2, $orden);
        
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
                            $orden ="id";

                            $traerProducto = ModelProducts::mdlShowProducts($tablaProductos, $item, $valor, $orden);
                         
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

        /*========================================
        =        Rango para las fechas de venta.     =
        =============================================*/

    static public function ctrRangesSaleDates($fechaInicial, $fechaFinal){

        $tabla = "ventas";

        $respuesta = SalesModel::mdlRangesSaleDates($tabla, $fechaInicial, $fechaFinal);

        return $respuesta;
    }

        /*========================================
        =        Descargar Excel.      =
        =============================================*/

    static public function ctrDownloadReport(){

            if(isset($_GET["reporte"])){

                $tabla = "ventas";
    
                if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"])){
    
                    $ventas = SalesModel::mdlRangesSaleDates($tabla, $_GET["fechaInicial"], $_GET["fechaFinal"]);
    
                }else{
    
                    $item = null;
                    $valor = null;
    
                    $ventas = SalesModel::mdlShowSales($tabla, $item, $valor);
    
                }
    
    
                /*=============================================
                Creando el archovo en Excel
                =============================================*/
    
                $Name = $_GET["reporte"].'.xls';
    
                header('Expires: 0');
                header('Cache-control: private');
                header("Content-type: application/vnd.ms-excel"); // Archivo de Excel
                header("Cache-Control: cache, must-revalidate"); 
                header('Content-Description: File Transfer');
                header('Last-Modified: '.date('D, d M Y H:i:s'));
                header("Pragma: public"); 
                header('Content-Disposition:; filename="'.$Name.'"');
                header("Content-Transfer-Encoding: binary");
    
                echo utf8_decode("<table border='0'> 
    
                        <tr> 
                            <td style='font-weight:bold; border:1px solid #eee;'>CÓDIGO</td> 
                            <td style='font-weight:bold; border:1px solid #eee;'>CLIENTE</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>VENDEDOR</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>CANTIDAD</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>PRODUCTOS</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>IMPUESTO</td>
                            <td style='font-weight:bold; border:1px solid #eee;'>NETO</td>		
                            <td style='font-weight:bold; border:1px solid #eee;'>TOTAL</td>		
                            <td style='font-weight:bold; border:1px solid #eee;'>METODO DE PAGO</td	
                            <td style='font-weight:bold; border:1px solid #eee;'>FECHA</td>		
                        </tr>");
    
                foreach ($ventas as $row => $item){
    
                    $cliente = ControllerClient::ctrShowClient("id", $item["id_cliente"]);
                    $vendedor = ControllersUsers::ctrshowusers("id", $item["id_vendedor"]);
    
                 echo utf8_decode("<tr>
                             <td style='border:1px solid #eee;'>".$item["codigo"]."</td> 
                             <td style='border:1px solid #eee;'>".$cliente["nombre"]."</td>
                             <td style='border:1px solid #eee;'>".$vendedor["nombre"]."</td>
                             <td style='border:1px solid #eee;'>");
    
                     $productos =  json_decode($item["productos"], true);
    
                     foreach ($productos as $key => $valueProductos) {
                             
                             echo utf8_decode($valueProductos["cantidad"]."<br>");
                         }
    
                     echo utf8_decode("</td><td style='border:1px solid #eee;'>");	
    
                     foreach ($productos as $key => $valueProductos) {
                             
                         echo utf8_decode($valueProductos["descripcion"]."<br>");
                     
                     }
    
                     echo utf8_decode("</td>
                        <td style='border:1px solid #eee;'>$ ".number_format($item["impuesto"],2)."</td>
                        <td style='border:1px solid #eee;'>$ ".number_format($item["neto"],2)."</td>	
                        <td style='border:1px solid #eee;'>$ ".number_format($item["total"],2)."</td>
                        <td style='border:1px solid #eee;'>".$item["metodo_pago"]."</td>
                        <td style='border:1px solid #eee;'>".substr($item["fecha"],0,10)."</td>		
                         </tr>");
    
    
                }
    
    
                echo "</table>";
    
            }


    }

        /*========================================
        =        Suma de las ventas.      =
        =============================================*/
    
    static public function ctrTotalSumSales(){

        $tabla = "ventas";

       
        
        $respuesta = SalesModel::mdlTotalSumSales($tabla);

		return $respuesta;

    }

        /*========================================
        =       Descargara factura electronica en formato xml.      =
        =============================================*/

    static public function ctrDownloadXML(){

        if(isset($_GET["xml"])){


            $tabla = "ventas";
			$item = "codigo";
            $valor = $_GET["xml"];
            
            $ventas = SalesModel::mdlShowSales($tabla, $item, $valor);

            //productos

            $listaProductos = json_decode($ventas["productos"], true);


            //Cliente.
                
            $tablaClientes = "clientes";
			$item = "id";
            $valor = $ventas["id_cliente"];
            
            $traerCliente = ModelClient::mdlShowClient($tablaClientes, $item, $valor);

            //vendedores.

            $tablaVendedor = "usuarios";
			$item = "id";
            $valor = $ventas["id_vendedor"];
            
            $traerVendedor = ModelsUsers::Mdlshowusers($tablaVendedor, $item, $valor);
        

            //http://php.net/manual/es/book.xmlwriter.php

            $objetoXML = new XMLWriter();
            
            $objetoXML->openURI($_GET["xml"].".xml"); //Creación del archivo XML

            $objetoXML->setIndent(true); //recibe un valor booleano para establecer si los distintos niveles de nodos XML deben quedar indentados o no.

            $objetoXML->setIndentString("\t"); // carácter \t, que corresponde a una tabulación

            $objetoXML->startDocument('1.0', 'utf-8');// Inicio del documento



            // $objetoXML->startElement("etiquetaPrincipal");// Inicio del nodo raíz

			// $objetoXML->writeAttribute("atributoEtiquetaPPal", "valor atributo etiqueta PPal"); // Atributo etiqueta principal

			// 	$objetoXML->startElement("etiquetaInterna");// Inicio del nodo hijo

			// 		$objetoXML->writeAttribute("atributoEtiquetaInterna", "valor atributo etiqueta Interna"); // Atributo etiqueta interna

			// 		$objetoXML->text("Texto interno");// Inicio del nodo hijo
			
			// 	$objetoXML->endElement(); // Final del nodo hijo
			
			// $objetoXML->endElement(); // Final del nodo raíz


            $objetoXML->writeRaw('<fe:Invoice xmlns:fe="http://www.dian.gov.co/contratos/facturaelectronica/v1" xmlns:cac="urn:oasis:names:specification:ubl:schema:xsd:CommonAggregateComponents-2" xmlns:cbc="urn:oasis:names:specification:ubl:schema:xsd:CommonBasicComponents-2" xmlns:clm54217="urn:un:unece:uncefact:codelist:specification:54217:2001" xmlns:clm66411="urn:un:unece:uncefact:codelist:specification:66411:2001" xmlns:clmIANAMIMEMediaType="urn:un:unece:uncefact:codelist:specification:IANAMIMEMediaType:2003" xmlns:ext="urn:oasis:names:specification:ubl:schema:xsd:CommonExtensionComponents-2" xmlns:qdt="urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2" xmlns:sts="http://www.dian.gov.co/contratos/facturaelectronica/v1/Structures" xmlns:udt="urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.dian.gov.co/contratos/facturaelectronica/v1 ../xsd/DIAN_UBL.xsd urn:un:unece:uncefact:data:specification:UnqualifiedDataTypesSchemaModule:2 ../../ubl2/common/UnqualifiedDataTypeSchemaModule-2.0.xsd urn:oasis:names:specification:ubl:schema:xsd:QualifiedDatatypes-2 ../../ubl2/common/UBL-QualifiedDatatypes-2.0.xsd">');


                $objetoXML->writeRaw('<ext:UBLExtensions>');

			foreach ($listaProductos as $key => $value) {
				
				$objetoXML->text($value["descripcion"].", ");
			
			}

			

			$objetoXML->writeRaw('</ext:UBLExtensions>');

			$objetoXML->writeRaw('</fe:Invoice>');

            

            $objetoXML->endDocument(); // Final del documento

            return true;
        }
    }
        
}