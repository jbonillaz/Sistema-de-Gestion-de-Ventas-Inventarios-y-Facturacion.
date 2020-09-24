<div class="content-wrapper">

    <section class="content-header">
        
        <h1>
        
        Administrar Categorias
        
        </h1>

        <ol class="breadcrumb">
        
        <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
        
        <li class="active">Administrar Categorias</li>
        
        </ol>

    </section>

        <!-- Main content -->
    <section class="content">

            <!-- Default box -->
        <div class="box">
                <div class="box-header with-border">
                
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
                    Agregar Categoria
                </button>
                    
                </div>

            <div class="box-body">
                
            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
                    <thead>
                    
                        <tr>
                        
                        <th style="width:10px">#</th>
                        <th>Categoria</th>
                        <th>Acciones</th>

                        </tr> 

                    </thead>

                    <tbody>
                            <tr>
                            <td>1</td>
                            <td>Cajas de Carton</td>
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
    =        Modal para agregar categoria.       =
    =============================================-->
  <div id="modalAgregarCategoria" class="modal fade" role="dialog">
    
    <div class="modal-dialog">

        <div class="modal-content">

            <form role="form" method="post">

                        <!--========================================
                        =        Modal Cabezera principal        =
                        =============================================-->

                <div class="modal-header" style="background: #3c8dbc; color:white">

                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    
                    <h4 class="modal-title">Agregar Categoria</h4>

                </div>

                        <!--========================================
                        =        Cuerpo del Modal        =
                        =============================================-->

                <div class="modal-body">

                    <div class="box-body">

                        <!-- Entrada para el Nombre-->  

                        <div class="form-group">

                            <div class="input-group">

                                <span class="input-group-addon"><i class="fa fa-th"></i></span>

                                <input type="text"  class="form-control" name="nuevaCategoria" placeholder="Ingresar Categoria" require>

                            </div>

                        </div>

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