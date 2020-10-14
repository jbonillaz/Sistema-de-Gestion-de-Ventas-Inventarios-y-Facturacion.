<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Crear venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Crear venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      El formulario
      ======================================-->
      
      <div class="col-lg-5 col-xs-12">
        
        <div class="box box-success">
          
          <div class="box-header with-border"></div>

          <form role="form" metohd="post" class="formularioVenta">

            <div class="box-body">
  
              <div class="box">

                <!--=====================================
                Entrada para el vendedor.
                ======================================-->
            
                <div class="form-group">
                
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div> 

                <!--=====================================
                Codigo de la venta.
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-key"></i></span>
                      <?php 
                        // preguntamos si no existe alguna venta.
                        $item = null;
                        $valor = null;

                        $ventas = SalesController::ctrShowSales($item, $valor);

                        if(!$ventas){

                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="10001" readonly>';
                      

                        }else{

                          foreach ($ventas as $key => $value) {
                            
                            
                          
                          }

                          $codigo = $value["codigo"] + 1;



                          echo '<input type="text" class="form-control" id="nuevaVenta" name="nuevaVenta" value="'.$codigo.'" readonly>';
                  

                    }
          
                      
                      ?>
                    

                  </div>
                
                </div>

                <!--=====================================
                Entrada del cliente.
                ======================================--> 

                <div class="form-group">
                  
                  <div class="input-group">
                    
                    <span class="input-group-addon"><i class="fa fa-users"></i></span>
                    
                    <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>

                    <option value="">Seleccionar cliente</option>

                      <?php 
                          // preguntamos si no existe alguna venta.
                          $item = null;
                          $valor = null;
                          
                          $categorias = ControllerClient::ctrShowClient($item, $valor);

                            foreach ($categorias as $key => $value){

                              echo '<option value="'.$value["id"].'">'.$value["nombre"].'</option>';

                            }
                        
                      ?>

                    </select>
                    
                    <span class="input-group-addon"><button type="button" class="btn btn-default btn-xs" data-toggle="modal" data-target="#modalAgregarCliente" data-dismiss="modal">Agregar cliente</button></span>
                  
                  </div>
                
                </div>

                <!--=====================================
                Entrada para agregar producto.
                ======================================--> 

                <div class="form-group row nuevoProducto">

                  <!-- Descripción del producto -->
                  
                  <!-- <div class="col-xs-6" style="padding-right:0px">
                  
                    <div class="input-group">
                      
                      <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></span>

                      <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripción del producto" required>

                    </div>

                  </div> -->

                  <!-- Para modificar la cantidad del producto -->

                  <!-- <div class="col-xs-3">
                    
                     <input type="number" class="form-control" id="nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" placeholder="0" required>

                  </div>  -->

                  <!-- Precio del producto -->

                  <!-- <div class="col-xs-3" style="padding-left:0px">

                    <div class="input-group">

                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                         
                      <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required>
         
                    </div>
                     
                  </div>  -->

                </div>

                <!--=====================================
                Boton para agregar producto, solo aplica en dispositivos moviles, resoluciones pequeñas.
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg">Agregar producto</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  Entrada para el impuedto y total.
                  ======================================-->
                  
                  <div class="col-xs-8 pull-right">
                    
                    <table class="table">

                      <thead>

                        <tr>
                          <th>Impuesto</th>
                          <th>Total</th>      
                        </tr>

                      </thead>

                      <tbody>
                      
                        <tr>
                          
                          <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required>
                              <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                        
                            </div>

                          </td>

                           <td style="width: 50%">
                            
                            <div class="input-group">
                           
                              <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>

                              <input type="number" min="1" class="form-control" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="00000" readonly required>
                              
                        
                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <!--=====================================
                Entrada para metodo de pago
                ======================================-->

                <div class="form-group row">
                  
                  <div class="col-xs-6" style="padding-right:0px">
                    
                     <div class="input-group">
                  
                      <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                        <option value="">Seleccione método de pago</option>
                        <option value="efectivo">Efectivo</option>
                        <option value="tarjetaCredito">Tarjeta Crédito</option>
                        <option value="tarjetaDebito">Tarjeta Débito</option>                  
                      </select>    

                    </div>

                  </div>

                  <div class="col-xs-6" style="padding-left:0px">
                        
                    <div class="input-group">
                         
                      <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="Código transacción"  required>
                           
                      <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                      
                    </div>

                  </div>

                </div>

                <br>
      
              </div>

          </div>

          <div class="box-footer">

            <button type="submit" class="btn btn-primary pull-right">Guardar venta</button>

          </div>

        </form>

        </div>
            
      </div>

      <!--=====================================
      LA TABLA DE PRODUCTOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
        
        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">
            
            <table class="table table-bordered table-striped dt-responsive tablaVentas">
              
               <thead>

                 <tr>
                  <th style="width: 10px">#</th>
                  <th>Imagen</th>
                  <th>Código</th>
                  <th>Descripcion</th>
                  <th>Stock</th>
                  <th>Acciones</th>
                </tr>

              </thead>

            </table>

          </div>

        </div>


      </div>

    </div>
   
  </section>

</div>
    <!--========================================
    =        Modal para agregar cliente.       =
    =============================================-->
<div id="modalAgregarCliente" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                        <!--========================================
                        =        Modal Cabezera principal        =
                        =============================================-->

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 class="modal-title">Agregar Cliente</h4>

                </div>

                        <!--========================================
                        =        Cuerpo del Modal        =
                        =============================================-->

                <div class="modal-body">

                    <div class="box-body">

                      <!-- Entrada para el Nombre-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-user"></i></span>

                          <input type="text"  class="form-control input-lg" name="nuevoCliente" placeholder="Ingrese el nombre" require>

                        </div>

                      </div>

                      <!-- Entrada para el documento ID-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="number"  min="0" class="form-control input-lg" name="nuevoDocumentoId" placeholder="Ingrese el Documento." require>

                        </div>

                      </div>

                          <!-- Entrada para el el email-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email"  class="form-control input-lg" name="nuevoEmail" placeholder="Ingrese Email." require>

                        </div>

                      </div>

                           <!-- Entrada para el el telefono-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control input-lg" name="nuevoTelefono" placeholder="Ingresar teléfono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                       
                        </div>

                      </div>

                      <!-- Entrada para el la direccion-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                          <input type="text"  class="form-control input-lg" name="nuevaDireccion" placeholder="Ingresar direccion" require>

                        </div>

                      </div>

                      <!-- Entrada para la fecha de nacimiento-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control input-lg" name="nuevaFechaNacimiento" placeholder="Ingresar fecha nacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                        </div>

                      </div>

                    </div>

                </div>

                        <!--========================================
                        =        Pie de pagina del modal       =
                        =============================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                     <button type="submit" class="btn btn-primary">Guardar Cliente</button>
                        
                </div>

            </form>

            <?php
            
            $crearCliente = new ControllerClient();
            $crearCliente -> ctrCreateClient();
            
            ?>

        </div>

    </div>

</div>