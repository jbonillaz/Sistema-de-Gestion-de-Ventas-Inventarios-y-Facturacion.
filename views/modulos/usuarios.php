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
        
      <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
      <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Nombre</th>
           <th>Usuario</th>
           <th>Foto</th>
           <th>Perfil</th>
           <th>Estado</th>
           <th>Último login</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>
      
        <?php

          
          $item = null;
          $valor = null;
          $usuarios = ControllersUsers::ctrshowusers($item, $valor);

          // var_dump($usuarios);
          // array que trae la base de datos para mostrar los usuarios en la plantilla de usuarios
          foreach ($usuarios as $key => $valor){

            echo '<tr>
                      <td>'.$valor["id"].'</td>
                      <td>'.$valor["nombre"].'</td>
                      <td>'.$valor["usuario"].'</td>';
                      
                      
              if($valor["foto"] != ""){

                echo '<td><img src="'.$valor["foto"].'" class="img-thumbnail" width="40px"> </td>';
              }else{
                echo '<td><img src="views/img/users/default/anonymous.png" class="img-thumbnail" width="40px"> </td>';
              }

                    
             echo '<td>'.$valor["perfil"].'</td>
                      <td><button class="btn btn-success btn-xs">Activado</button></td>
                      <td>'.$valor["ultimo_login"].'</td>
                      <td>
                        <div class="btn-group">
                          <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
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
<!--========================================
  =        Modal Ingresar usuarios        =
  =============================================-->
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        Cabeza del modal
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        Cuerpo del modal
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- Ingreso del nombre -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- Engreso del usuario -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- Ingreso de contraseña -->

             <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- Seleccioon de perfil de usuario-->

            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                </select>

              </div>

            </div>

            <!-- CXargar foto-->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="views/img/users/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>

          </div>

        </div>

        <!--=====================================
        Pie de pagina del modal
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>
        <?php

        $CreateUser = new ControllersUsers();
        $CreateUser -> ctrCreateUser();

        ?>

        </form>

    </div>

  </div>

</div>