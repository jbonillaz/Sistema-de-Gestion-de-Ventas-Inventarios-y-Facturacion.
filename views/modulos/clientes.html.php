<div class="content-wrapper">

    <section class="content-header">
        
        <h1>
        
        Administrar Clientes
        
        </h1>

        <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar Clientes</li>
        
        </ol>

    </section>

        <!-- Main content -->
    <section class="content">

            <!-- Default box -->
        <div class="box">
                <div class="box-header with-border">
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
                    Agregar Clientes
                    
                </div>

            <div class="box-body">
                
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                    
                        <tr>
                        
                        <th style="width:10px">#</th>
                        <th>Nombre</th>
                        <th>Docuemnto ID</th>
                        <th>Email</th>
                        <th>Direccion</th>
                        <th>Fechanacimiento</th>
                        <th>Total Compras</th>
                        <th>Ultima Compra</th>
                        <th>Ingreso al Sistemas</th>
                        <th>Acciones</th>

                        </tr> 

                    </thead>

                    <tbody>
                            <tr>
                            <td>1</td>
                            <td>Jose Carmelo</td>
                            <td>1020722444</td>
                            <td>cometidas@gmail.com</td>
                            <td>Yopal Casanare</td>
                            <td>15-06-1991</td>
                            <td>10</td>
                            <td>09-10-2020</td>
                            <td>09-10-2019</td>
                            <td>
                                <div class="btn-group">
                                <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                                <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                                </div>
                            </td>
                            </tr>
                    </tbody>
                </table>
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

        </div>

    </div>

</div>