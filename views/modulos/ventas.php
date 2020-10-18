<div class="content-wrapper">

    <section class="content-header">
        
        <h1>
        
        Administrar Ventas
        
        </h1>

        <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar ventas</li>
        
        </ol>

    </section>

        <!-- Main content -->
    <section class="content">

            <!-- Default box -->
        <div class="box">
                <div class="box-header with-border">
                <a href="crear-venta">
                  <button class="btn btn-primary">
                      Agregar Venta
                      
                  </div>
                </a>

            <div class="box-body">
                
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                    
                        <tr>
                        
                        <th style="width:10px">#</th>
                        <th>Codigo factura</th>
                        <th>Cliente</th>
                        <th>Vendedor</th>
                        <th>Forma de pago</th>
                        <th>Neto</th>
                        <th>Total</th>
                        <th>Fecha</th>
                        <th>Acciones</th>

                        </tr> 

                    </thead>

                    <tbody>
                            <!-- mostrar las ventas en el sistema. -->
                        <?php 

                            $item = null;
                            $valor = null;

                            $respuesta = SalesController::ctrShowSales($item, $valor);

                            foreach ($respuesta as $key => $value) {

                                echo '<tr>
                                        <td>'.($key+1).'</td>
                                        <td>'.$value["codigo"].'</td>';

                                        $itemCliente = "id";
                                        $valorCliente = $value["id_cliente"];

                                        $respuestaCliente = ControllerClient::ctrShowClient($itemCliente, $valorCliente);

                                        echo '<td>'.$respuestaCliente["nombre"].'</td>';

                                        $itemUsuario = "id";
                                        $valorUsuario = $value["id_vendedor"];

                                        $respuestaUsuario = ControllersUsers::ctrshowusers($itemUsuario, $valorUsuario);

                                        echo '<td>'.$respuestaUsuario["nombre"].'</td>

                                        <td>'.$value["metodo_pago"].'</td>

                                        <td>$ '.number_format($value["neto"],2).'</td>

                                        <td>$ '.number_format($value["total"],2).'</td>

                                        <td>'.$value["fecha"].'</td>

                                        <td>
                                            <div class="btn-group">
                                            <button class="btn btn-info"><i class="fa fa-print"></i></button>

                                            <button class="btn btn-warning btnEditarVenta" idVenta="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

                                            <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                            </div>
                                        </td>
                                    </tr>';

                            }


                        ?>  
                           
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</div>