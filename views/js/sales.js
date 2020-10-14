/*========================================
  =  Cargar la tabla dinamica de ventas. =
  =============================================*/

//   $.ajax({

//   	url: "ajax/datatable-sales.ajax.php",
//   	success:function(respuesta){

//   		console.log("respuesta", respuesta);

//   	}

//   });

$(".tablaVentas").DataTable({
    ajax: "ajax/datatable-sales.ajax.php",
    deferRender: true,
    retrieve: true,
    processing: true,
    language: {
      sProcessing: "Procesando...",
      sLengthMenu: "Mostrar _MENU_ registros",
      sZeroRecords: "No se encontraron resultados",
      sEmptyTable: "No hay datos disponibles en esta tabla",
      sInfo: "Registros del _START_ al _END_ de un total de _TOTAL_",
      sInfoEmpty: "Registros del 0 al 0 de un total de 0",
      sInfoFiltered: "(filtrado de un total de _MAX_ registros)",
      sInfoPostFix: "",
      sSearch: "Buscar:",
      sUrl: "",
      sInfoThousands: ",",
      sLoadingRecords: "Cargando...",
      oPaginate: {
        sFirst: "Primero",
        sLast: "Último",
        sNext: "Siguiente",
        sPrevious: "Anterior",
      },
      oAria: {
        sSortAscending: ": Activar para ordenar la columna de manera ascendente",
        sSortDescending:
          ": Activar para ordenar la columna de manera descendente",
      },
    },
  });

  /*========================================
  =  Agregamos productos a la venta desde la TablaVentas. =
  =============================================*/
$(".tablaVentas tbody").on("click", "button.agregarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    // console.log("idProducto", idProducto);
    $(this).removeClass("btn-primary agregarProducto");

    $(this).addClass("btn-default");
    
    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({

        url:"ajax/products.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType:"json",
        success:function(respuesta){

            // console.log("respuesta", respuesta);
            var descripcion = respuesta["descripcion"];
          	var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];

            /*========================================
            =  Evitar agregar productos cuando el stock sea == 0. =
            =============================================*/

              if(stock == 0){

                swal({
                title: "El producto no esta disponible disponible",
                type: "error",
                confirmButtonText: "¡Cerrar!"
              });
    
              $("button[idProducto='"+idProducto+"']").addClass("btn-primary agregarProducto");
    
              return;
    
                }
                /*esta era la estructura que estaba en html, 
                se colocan en el js para que se agrege de 
                manera dinamica a la factura, nombre de producto
                 y precio de venta.*/
              $(".nuevoProducto").append(
              
              '<div class="row" style="padding:5px 15px">'+

			  '<!-- Descripción del producto -->'+
	          
	          '<div class="col-xs-6" style="padding-right:0px">'+
	          
	            '<div class="input-group">'+
	              
	              '<span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'"><i class="fa fa-times"></i></button></span>'+

	              '<input type="text" class="form-control nuevaDescripcionProducto" idProducto="'+idProducto+'" name="agregarProducto" value="'+descripcion+'" readonly required>'+

	            '</div>'+

	          '</div>'+

	          '<!-- Cantidad del producto -->'+

	          '<div class="col-xs-3">'+
	            
	             '<input type="number" class="form-control nuevaCantidadProducto" name="nuevaCantidadProducto" min="1" value="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" required>'+

	          '</div>' +

	          '<!-- Precio del producto -->'+

	          '<div class="col-xs-3 ingresoPrecio" style="padding-left:0px">'+

	            '<div class="input-group">'+

	              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
	                 
	              '<input type="text" class="form-control nuevoPrecioProducto" precioReal="'+precio+'" name="nuevoPrecioProducto" value="'+precio+'" readonly required>'+
	 
	            '</div>'+
	             
	          '</div>'+

	        '</div>'
            );
        }

    });

  });

  /*========================================
  =  Cuando cargue la tabla cada vez que navegue en ella. =
  =============================================*/
  $(".tablaVentas").on("draw.dt", function(){

    // console.log("tabla");

    if(localStorage.getItem("quitarProducto") != null){

      var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
  
      for(var i = 0; i < listaIdProductos.length; i++){
  
        $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").removeClass('btn-default');
        $("button.recuperarBoton[idProducto='"+listaIdProductos[i]["idProducto"]+"']").addClass('btn-primary agregarProducto');
  
      }
  
  
    }



  });




  /*========================================
  =  Quitar productos de la venta y recuperar el boton. =
  =============================================*/

  var idQuitarProducto = [];
  // Remover el item cada vez que se carga la pagina.
  localStorage.removeItem("quitarProducto");

  $(".formularioVenta").on("click", "button.quitarProducto", function(){

    // console.log("button");
// accion para borrar los productos adicionados.
    $(this).parent().parent().parent().parent().remove();

    var idProducto = $(this).attr("idProducto");

      /*========================================
      =  Almacenar en el local storage el ID del productoa quitar. =
      =============================================*/

      if(localStorage.getItem("quitarProducto") == null){

        idQuitarProducto = [];
      
      }else{
    
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    
      }

      idQuitarProducto.push({"idProducto":idProducto});

    	localStorage.setItem("quitarProducto", JSON.stringify(idQuitarProducto));

    $("button.recuperarBoton[idProducto='"+idProducto+"']").removeClass('btn-default');
      // activa nuevamente el boton despues de agregarlo y removerlo.
     $("button.recuperarBoton[idProducto='"+idProducto+"']").addClass('btn-primary agregarProducto');  



  });