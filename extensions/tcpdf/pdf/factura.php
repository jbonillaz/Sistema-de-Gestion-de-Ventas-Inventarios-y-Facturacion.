<?php

require_once "../../../controllers/sales.controller.php";
require_once "../../../models/sales.model.php";

require_once "../../../controllers/clients.controller.php";
require_once "../../../models/clients.model.php";

require_once "../../../controllers/users.controller.php";
require_once "../../../models/users.model.php";

require_once "../../../controllers/products.controller.php";
require_once "../../../models/products.model.php";

class imprimirFactura{

	public $codigo;

	public function traerImpresionFactura(){

		//Traemos la informacion de la venta.

		$itemVenta = "codigo";
		$valorVenta = $this->codigo;

		$respuestaVenta = SalesController::ctrShowSales($itemVenta, $valorVenta);

		$fecha = substr($respuestaVenta["fecha"],0,-8);
		$productos = json_decode($respuestaVenta["productos"], true);
		$neto = number_format($respuestaVenta["neto"],2);
		$impuesto = number_format($respuestaVenta["impuesto"],2);
		$total = number_format($respuestaVenta["total"],2);

		//Traemos la informacion del cliente.

		$itemCliente = "id";
		$valorCliente = $respuestaVenta["id_cliente"];

		$respuestaCliente = ControllerClient::ctrShowClient($itemCliente, $valorCliente);

		//Traemos la informacion del vendedor.

		$itemVendedor = "id";
		$valorVendedor = $respuestaVenta["id_vendedor"];

		$respuestaVendedor = ControllersUsers::ctrshowusers($itemVendedor, $valorVendedor);

		//Requerimos la clase TCPDF

		require_once('tcpdf_include.php');

		$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

		$pdf->startPageGroup();

		$pdf->AddPage();

		// ---------------------------------------------------------
		// Encabezado de la factura. 

		$bloque1 = <<<EOF

			<table>
				
				<tr>
					
					<td style="width:150px"><img src="images/logo-negro-bloque.png"></td>

					<td style="background-color:white; width:140px">
						
						<div style="font-size:8.5px; text-align:right; line-height:15px;">
							
							<br>
							NIT: 1.118´569.368
							<br>
							Dirección: Calle 29 #6Bis-92
							<br>
							Yopal - Casanare

						</div>

					</td>

					<td style="background-color:white; width:140px">

						<div style="font-size:8.5px; text-align:right; line-height:15px;">
							
							<br>
							Teléfono: (311) 519-5299
							
							<br>
							linarozo27@gmail.com

						</div>
						
					</td>

					<td style="background-color:white; width:110px; text-align:center; color:red"><br><br>FACTURA #.<br>$valorVenta</td>

				</tr>

			</table>

		EOF;

		$pdf->writeHTML($bloque1, false, false, false, false, '');

		// ---------------------------------------------------------
		//Informacion del Cliente, Vendedor y fecha de emision de la factura.

		$bloque2 = <<<EOF

			<table>
				
				<tr>
					
					<td style="width:540px"><img src="images/back.jpg"></td>
				
				</tr>

			</table>

			<table style="font-size:10px; padding:5px 10px;">
			
				<tr>
				
					<td style="border: 1px solid #666; background-color:white; width:390px">

					<b>Cliente:</b> $respuestaCliente[nombre]

					</td>

					<td style="border: 1px solid #666; background-color:white; width:150px; text-align:right">
					
						<b>Fecha:</b> $fecha

					</td>

				</tr>

				<tr>
				
					<td style="border: 1px solid #666; background-color:white; width:540px"><b>Vendedor:</b> $respuestaVendedor[nombre]</td>

				</tr>

				<tr>
				
				<td style="border-bottom: 1px solid #666; background-color:white; width:540px"></td>

				</tr>

			</table>

		EOF;

		$pdf->writeHTML($bloque2, false, false, false, false, '');

		// ---------------------------------------------------------
		//Nombres de las encabezado de la tabla.

		$bloque3 = <<<EOF

			<table style="font-size:10px; padding:5px 10px;">

				<tr>
				
				<td style="border: 1px solid #666; background-color:white; width:260px; text-align:center"><b>Producto</b></td>
				<td style="border: 1px solid #666; background-color:white; width:80px; text-align:center"><b>Cantidad</b></td>
				<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Valor Unit.</b></td>
				<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center"><b>Valor Total</b></td>

				</tr>

			</table>

		EOF;

		$pdf->writeHTML($bloque3, false, false, false, false, '');

		// ---------------------------------------------------------
		//Nos muestra la informaqcion de la venta.

		foreach ($productos as $key => $item) {

		$itemProducto = "descripcion";
		$valorProducto = $item["descripcion"];
		$orden = null;

		$respuestaProducto = ControllerProducts::ctrShowProducts($itemProducto, $valorProducto, $orden);

		$valorUnitario = number_format($respuestaProducto["precio_venta"], 2);

		$precioTotal = number_format($item["total"], 2);

		$bloque4 = <<<EOF

			<table style="font-size:10px; padding:5px 10px;">

				<tr>
					
					<td style="border: 1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
						$item[descripcion]
					</td>

					<td style="border: 1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
						$item[cantidad]
					</td>

					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
						$valorUnitario
					</td>

					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">$ 
						$precioTotal
					</td>


				</tr>

			</table>


		EOF;

		$pdf->writeHTML($bloque4, false, false, false, false, '');

		}

		// ---------------------------------------------------------
		//Informacion del impuesto y total a pagar.

		$bloque5 = <<<EOF

			<table style="font-size:10px; padding:5px 10px;">

				<tr>

					<td style="color:#333; background-color:white; width:340px; text-align:center"></td>

					<td style="border-bottom: 1px solid #666; background-color:white; width:100px; text-align:center"></td>

					<td style="border-bottom: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>

				</tr>
				
				<tr>
				
					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666;  background-color:white; width:100px; text-align:center">
						<b>Neto:</b>
					</td>

					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $neto
					</td>

				</tr>

				<tr>

					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
					<b>Impuesto:</b>
					</td>
				
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $impuesto
					</td>

				</tr>

				<tr>
				
					<td style="border-right: 1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>

					<td style="border: 1px solid #666; background-color:white; width:100px; text-align:center">
					<b>Total:</b>
					</td>
					
					<td style="border: 1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
						$ $total
					</td>

				</tr>


			</table>

		EOF;

		$pdf->writeHTML($bloque5, false, false, false, false, '');



		// ---------------------------------------------------------
		//Salida para el archivo 

		$pdf->Output('factura.pdf', 'D');

	}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>