<?php

if($_SESSION["perfil"] == "Especial"){

  echo '<script>

    window.location = "inicio";

  </script>';

  return;

}

?>

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
                  <th>Telefono</th>
                  <th>Direccion</th>
                  <th>Fechanacimiento</th>
                  <th>Total Compras</th>
                  <th>Ultima Compra</th>
                  <th>Ingreso al Sistemas</th>
                  <th>Acciones</th>

                </tr> 

            </thead>

          <tbody>

            <?php 

              $item = null;
              $valor = null;

              $clientes = ControllerClient::ctrShowClient($item, $valor);

              // var_dump($clientes);
                        
                      foreach ($clientes as $key => $value) {
            

                        echo '<tr>
            
                                <td>'.($key+1).'</td>
            
                                <td>'.$value["nombre"].'</td>
            
                                <td>'.$value["documento"].'</td>
            
                                <td>'.$value["email"].'</td>
            
                                <td>'.$value["telefono"].'</td>
            
                                <td>'.$value["direccion"].'</td>
            
                                <td>'.$value["fecha_nacimiento"].'</td>             
            
                                <td>'.$value["compras"].'</td>
            
                                <td>'.$value["ultima_compra"].'</td>
            
                                <td>'.$value["fecha"].'</td>
            
                                <td>
            
                                <div class="btn-group">
                          
                                <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$value["id"].'"><i class="fa fa-pencil"></i></button>';

                                if($_SESSION["perfil"] == "Administrador"){

                                  echo'<button class="btn btn-danger btnEliminarCliente" idCliente="'.$value["id"].'"><i class="fa fa-times"></i></button>';
                                
                              }

                              echo'</div>  
            
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

<!--========================================
    =        Modal para editar cliente.       =
    =============================================-->
<div id="modalEditarCliente" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                        <!--========================================
                        =        Modal Cabezera principal        =
                        =============================================-->

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 class="modal-title">Editar Cliente</h4>

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

                          <input type="text"  class="form-control input-lg" name="editarCliente"  id="editarCliente" require>

                          <input type="hidden" id="idCliente" name="idCliente">
                        </div>

                      </div>

                      <!-- Entrada para el documento ID-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-key"></i></span>

                          <input type="number"  min="0" class="form-control input-lg" name="editarDocumentoId" id="editarDocumentoId" require>

                        </div>

                      </div>

                          <!-- Entrada para el el email-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-envelope"></i></span>

                          <input type="email"  class="form-control input-lg" name="editarEmail" id="editarEmail" require>

                        </div>

                      </div>

                           <!-- Entrada para el el telefono-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-phone"></i></span>

                          <input type="text" class="form-control input-lg" name="editarTelefono" id="editarTelefono" data-inputmask="'mask':'(999) 999-9999'" data-mask required>
                       
                        </div>

                      </div>

                      <!-- Entrada para el la direccion-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>

                          <input type="text"  class="form-control input-lg" name="editarDireccion" id="editarDireccion" require>

                        </div>

                      </div>

                      <!-- Entrada para la fecha de nacimiento-->  

                      <div class="form-group">

                        <div class="input-group">

                          <span class="input-group-addon"><i class="fa fa-calendar"></i></span>

                          <input type="text" class="form-control input-lg" name="editarFechaNacimiento" id="editarFechaNacimiento" data-inputmask="'alias': 'yyyy/mm/dd'" data-mask required>

                        </div>

                      </div>

                    </div>

                </div>

                        <!--========================================
                        =        Pie de pagina del modal       =
                        =============================================-->

                <div class="modal-footer">

                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
                     <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                        
                </div>

            </form>

                <?php 
                $editarCliente = new ControllerClient();
                $editarCliente -> ctrEditClient();
                ?>
           
        </div>

    </div>

</div>

<?php 
  $eliminaCliente = new ControllerClient();
  $eliminaCliente -> ctrDeleteClient();
?>