/*========================================
  =  Cargar la tabla dinamica de productos. =
  =============================================*/

  // $.ajax({

  //   	url: "ajax/datatable-products.ajax.php",
  //   	success:function(respuesta){
        
  //   		console.log("respuesta", respuesta);
    
  //   	}
    
  //   });

      $('.tablaProductos').DataTable( {
          "ajax": "ajax/datatable-products.ajax.php"
      } );

    