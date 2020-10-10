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
      </table>
      </div>
    </div>
  </section>
</div>
  <!--========================================
  =        Modal Ingresar productos        =
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


                <!-- Entrada para seleccionar Categoria-->  

            <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select class="form-control input-lg" id="nuevaCategoria" name="nuevaCategoria" required>
                    <option value="">Seleccionar Categoria</option>

                    <!-- trayendo la informacion de la base de dato.  -->

                      <?php 
                      
                        $item = null;
                        $valor = null;

                        $categorias = ControllerCategories::ctrShowCategories($item, $valor);

                        foreach ($categorias as $key => $value){

                          echo '<option value="'.$value["id"].'">'.$value["nombre_cat"].'</option>';
                        }
                        
                      ?>
                  
                  </select>

                  
                </div>

            </div>


             <!-- Entrada para el codigo-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text"  class="form-control" id="nuevoCodigo" name="nuevoCodigo" placeholder="Ingresar Codigo" readonly required>

              </div>

            </div>

            <!-- Entrada para la descripcion--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text"  class="form-control" name="nuevaDescripcion" placeholder="Ingresar Descripcion" require>

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

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioCompra" name="nuevoPrecioCompra" min="0" step="any" placeholder="Precio de compra" required>

                  </div>

                </div>
                        
                <!-- Entrada para precio de venta -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="nuevoPrecioVenta" name="nuevoPrecioVenta" min="0" step="any" placeholder="Precio de venta" required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX para porcentaje -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- Entrada para porcentaje -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

           <!-- Entrada cargar la foto-->  

            <div class="form-group">

                <div class="panel">Subir Imagen</div>

                <input type="file" class="nuevaImagen" name="nuevaImagen">

                <p class="help-block">Peso Maximo de la Foto 2 MB</p>

                <img src="views/img/products/default/productos.png" class="img.thumbnail previsualizar" width="100px">

            </div>
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

          $CreateProduct = new ControllerProducts();
          $CreateProduct -> ctrCreateProduct();

        ?>

        </form>

    </div>

  </div>

</div>

  <!--========================================
  =        Modal Editar Productos       =
  =============================================-->

<div id="modalEditarProducto" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

      <!--========================================
    =        Modal Cabezera principal        =
    =============================================-->

        <div class="modal-header" style="background: #3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
          <h4 class="modal-title">Editar Producto</h4>

        </div>

        <!--========================================
    =        Cuerpo del Modal        =
    =============================================-->

        <div class="modal-body">

          <div class="box-body">


                <!-- Entrada para seleccionar Categoria-->  

            <div class="form-group">

                <div class="input-group">

                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <select class="form-control input-lg"  name="editarCategoria" readonly required>
                   
                  <option id="editarCategoria"></option>

                  </select>

                  
                </div>

            </div>


            <!-- Entrada para el codigo-->  

            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-code"></i></span>

                <input type="text"  class="form-control input-lg" id="editarCodigo" name="editarCodigo" readonly required>

              </div>

            </div>

            <!-- Entrada para la descripcion--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>

                <input type="text"  class="form-control input-lg" id="editarDescripcion" name="editarDescripcion" require>

              </div>

            </div>


            <!-- Entrada para la disponiblidad del producto Stock--> 
            
            <div class="form-group">

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-check"></i></span>

                <input type="number"  class="form-control input-lg" id="editarStock" name="editarStock" min="0" require>

              </div>

            </div>

            <!-- Entrada para el precio compra--> 
            
            <div class="form-group row">

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioCompra" name="editarPrecioCompra" min="0" step="any" required>

                  </div>

                </div>
                        
                <!-- Entrada para precio de venta -->

                <div class="col-xs-12 col-sm-6">
                
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span> 

                    <input type="number" class="form-control input-lg" id="editarPrecioVenta" name="editarPrecioVenta" min="0" step="any" readonly required>

                  </div>
                
                  <br>

                  <!-- CHECKBOX para porcentaje -->

                  <div class="col-xs-6">
                    
                    <div class="form-group">
                      
                      <label>
                        
                        <input type="checkbox" class="minimal porcentaje" checked>
                        Utilizar procentaje
                      </label>

                    </div>

                  </div>

                  <!-- Entrada para porcentaje -->

                  <div class="col-xs-6" style="padding:0">
                    
                    <div class="input-group">
                      
                      <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required>

                      <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                    </div>

                  </div>

                </div>

            </div>

           <!-- Entrada cargar la foto-->  

            <div class="form-group">

                <div class="panel">Subir Imagen</div>

                <input type="file" class="nuevaImagen" name="editarImagen">

                <p class="help-block">Peso Maximo de la Foto 2 MB</p>

                <img src="views/img/products/default/productos.png" class="img.thumbnail previsualizar" width="100px">

                <input type="hidden" name="imagenActual" id="imagenActual">

            </div>
          </div>

        </div>

        <!--========================================
    =        Pie de pagina del modal       =
    =============================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Producto</button>
        
        </div>

        </form>

        <?php

          $editarProducto = new ControllerProducts();
          $editarProducto -> ctrEditProduct();

        ?>

    </div>

  </div>

</div>
<?php

     $eliminarProducto = new ControllerProducts();
     $eliminarProducto -> ctrDeleteProduct();

?>