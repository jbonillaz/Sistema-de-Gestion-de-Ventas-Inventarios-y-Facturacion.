<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar productos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar productos</li>
    
    </ol>

  </section>

  <!-- Main content -->
  <section class="content">

    <!-- Default box -->
    <div class="box">
      <div class="box-header with-border">
       
      <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProducto">
        Agregar Producto
      </button>
        
      </div>

      <div class="box-body">
        
      <table class="table table-bordered table-striped dt-responsive tablaProductos" width="100%">
          <!-- <thead>
          <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Extn.</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>

          </thead> -->
             
          <thead>
            
            <tr>
              
              <th style="width:10px">#</th>
              <th>Imagen</th>
              <th>Codigo</th>
              <th>Descripcion</th>
              <th>Categoria</th>
              <th>Stock</th>
              <th>Precio de Compra</th>
              <th>Precio de Venta</th>
              <th>Agregado</th>
              <th>Acciones</th>

            </tr> 

          </thead>

          <!-- <tbody>

            <?php

                $item = null;

                $valor = null;

                $productos = ControllerProducts::ctrShowProducts($item, $valor);

                // var_dump($productos)
              
              foreach ($productos as $key => $value){

                echo '<tr>
                
                <td>'.($key+1).'</td>
                  <td><img src="views/img/products/Bouquet_de_globos.png" class="img-thumbnail" width="40px"></td>
                  <td>'.$value["codigo"].'</td>
                  <td>'.$value["descripcion"].'</td>';

                      $item = "id";
                      $valor = $value["id_categoria"];

                    $categoria = ControllerCategories::ctrShowCategories($item, $valor);


                  echo '<td>'.$categoria["nombre_cat"].'</td>
                  <td>'.$value["stock"].'</td>
                  <td>'.$value["precio_compra"].'</td>
                  <td>'.$value["precio_venta"].'</td>
                  <td>'.$value["fecha"].'</td>
                  <td>
                    <div class="btn-group">
                      <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                      <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                    </div>
                  </td>
                
                
                
                </tr>';

              }


            ?>
            
          </tbody> -->
      </table>
      </div>
    </div>
  </section>
</div>
<!--========================================
  =        Modal Ingresar usuarios        =
  =============================================-->
  <div id="modalAgregarProducto" class="modal fade" role="dialog">
    
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!--========================================
    =        Modal Cabezera principal        =
    =============================================-->

        <div class="modal-header" style="background: #3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Agregar Producto</h4>

        </div>

        <!--========================================
    =        Cuerpo del Modal        =
    =============================================-->

        <div class="modal-body">

          <div class="box-body">

          <!-- Entrada para el codigo-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text"  class="form-control" name="nuevoCodigo" placeholder="Ingresar Codigo" require>

              </div>

            </div>

            <!-- Entrada para la descripcion--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text"  class="form-control" name="nuevaDescripcion" placeholder="Ingresar Descripcion" require>

              </div>

            </div>


            <!-- Entrada para seleccionar Categoria-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                <select class="form-control input-lg" name="nuevaCategoria">
                  <option value="">Seleccionar Categoria</option>
                  <option value="cajas">Cajas</option>
                  <option value="envases">Envases</option>
                  <option value="contenedores">Contenedores</option>
                </select>

                
              </div>

            </div>

            <!-- Entrada para la disponiblidad del producto Stock--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number"  class="form-control" name="nuevoStock" min="0" placeholder="Ingresar Stock " require>

              </div>

            </div>

            <!-- Entrada para el precio compra--> 
            
            <div class="form-group row">

              <div class="col-xs-6">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>

                  <input type="number"  class="form-control" name="nuevoPrecioCompra" min="0" placeholder="Precio de Compra" require>

                </div>
                   
                  <br>
                    <!-- Checbox para porcentaje -->
                    <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                <!-- Entrada para porcentaje. -->

                <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                 </div> 


              </div>
           
             <!-- Entrada para el precio de venta--> 
            
              <div class="col-xs-6" >

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>

                  <input type="number"  class="form-control" name="nuevoPrecioVenta" min="0" placeholder="Precio de Venta" require>

                </div>
            
              </div>

            </div>

           <!-- Entrada para seleccionar perfil-->  



            <div class="form-group">

            <div class="panel">Subir Imagen</div>

              <input type="file" id="nuevaInmagen" name="nuevaImagen">

              <p class="help-block">Peso Maximo de la Foto 2 MB</p>

              <img src="views/img/products/Bouquet_de_globos.png" class="img.thumbnail" width="100px">

            </div>
          

        </div>

        <!--========================================
    =        Pie de pagina del modal       =
    =============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        
        </div>

        <?php

        $CreateUser = new ControllersUsers();
        $CreateUser -> ctrCreateUser();

        ?>

        </form>

    </div>

  </div>

</div>