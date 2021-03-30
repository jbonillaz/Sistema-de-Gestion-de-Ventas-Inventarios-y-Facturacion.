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

$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);

$pdf->AddPage('P', 'A7');



// ---------------------------------------------------------
// Encabezado de la factura. 

$bloque1 = <<<EOF

	<table style="font-size:9px; text-align:center">

		<tr>
			
			<td style="width:160px;">
		
				<div>
				
					Fecha: $fecha

					<br><br>
					Llano Software
					
					<br>
					NIT: 1´116.546.916

					<br>
					Dirección: Carrera 13 # 25-91

					<br>
					Teléfono: 314 419 67 66

					<br>
					FACTURA N.$valorVenta

					<br><br>					
					Cliente: $respuestaCliente[nombre]

					<br>
					Vendedor: $respuestaVendedor[nombre]

					<br>

				</div>

			</td>

		</tr>


	</table>

EOF;

$pdf->writeHTML($bloque1, false, false, false, false, '');

// ---------------------------------------------------------

foreach ($productos as $key => $item) {

$valorUnitario = number_format($item["precio"], 2);

$precioTotal = number_format($item["total"], 2);

$bloque2 = <<<EOF


	<table style="font-size:9px;">

	<tr>
	
	<td style="width:160px; text-align:left">
	$item[descripcion] 
	</td>

	</tr>

	<tr>
	
	<td style="width:160px; text-align:right">
	$ $valorUnitario Und * $item[cantidad]  = $ $precioTotal
	<br>
	</td>

	</tr>

	</table>	

EOF;

$pdf->writeHTML($bloque2, false, false, false, false, '');
}
// ---------------------------------------------------------
//Nombres de las encabezado de la tabla.

$bloque3 = <<<EOF

<table style="font-size:9px; text-align:right">

	<tr>
	
		<td style="width:80px;">
			NETO: 
		</td>

		<td style="width:80px;">
			$ $neto
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			IMPUESTO: 
		</td>

		<td style="width:80px;">
			$ $impuesto
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			--------------------------
		</td>

	</tr>

	<tr>
	
		<td style="width:80px;">
			TOTAL: 
		</td>

		<td style="width:80px;">
			$ $total
		</td>

	</tr>

	<tr>
	
		<td style="width:160px;">
			<br>
			<br>
			Muchas gracias por su compra
		</td>

	</tr>

</table>
	
EOF;

$pdf->writeHTML($bloque3, false, false, false, false, '');



// ---------------------------------------------------------
//Salida para el archivo 

// $pdf->Output('factura.pdf', 'D');
$pdf->Output('factura.pdf');

}

}

$factura = new imprimirFactura();
$factura -> codigo = $_GET["codigo"];
$factura -> traerImpresionFactura();

?>