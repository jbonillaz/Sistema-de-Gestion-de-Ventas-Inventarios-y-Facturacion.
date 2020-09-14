<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar usuarios
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar usuarios</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
       
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
        Agregar Usuario
      </button>
        
      </div>

      <div class="box-body">
        
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th>#</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Foto</th>
            <th>Perfil</th>
            <th>estado</th>
            <th>Ultimo Login</th>
            <th>Acciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
            <td>Usuario Administrador</td>
            <td>admin</td>
            <td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"> </td>
            <td>Administrador</td>
            <td><button class="btn btn-success btn-xs">Activado</button></td>
            <td>2020-09-13</td>
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
  =        Modal Ingresar usuarios        =
  =============================================-->
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
    
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!--========================================
    =        Modal Cabezera principal        =
    =============================================-->

        <div class="modal-header" style="background: #3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Usuario</h4>

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

                <input type="text"  class="form-control" name="nuevoNombre" placeholder="Ingresar Nombre" require>

              </div>

            </div>

            <!-- Entrada para el Usuario--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-key"></i></span>

                <input type="text"  class="form-control" name="nuevoUsuario" placeholder="Ingresar Usuario" require>

              </div>

            </div>

            <!-- Entrada para el Contraseña-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                <input type="password"  class="form-control" name="nuevoPassword" placeholder="Ingresar Contraseña" require>

              </div>

            </div>


            <!-- Entrada para seleccionar perfil-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-users"></i></span>

                <select class="form-control input-lg" name="nuevoPerfil">
                  <option value="">Seleccionar Perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>

                
              </div>

            </div>

            <!-- Entrada para seleccionar perfil-->  



            <div class="form-group">

            <div class="panel">Subir Foto</div>

              <input type="file" id="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso Maximo de la Foto 200MB</p>

              <img src="views/img/users/default/anonymous.png" class="img.thumbnail" width="100px">

            </div>
          

        </div>

        <!--========================================
    =        Pie de pagina del modal       =
    =============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar</button>
        
        </div>

        </form>

    </div>

  </div>

</div>