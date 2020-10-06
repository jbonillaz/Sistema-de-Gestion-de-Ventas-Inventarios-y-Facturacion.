/*========================================
  =  Cargar la tabla dinamica de productos. =
  =============================================*/

// $.ajax({

//   	url: "ajax/datatable-products.ajax.php",
//   	success:function(respuesta){

//   		console.log("respuesta", respuesta);

//   	}

//   });

$(".tablaProductos").DataTable({
  ajax: "ajax/datatable-products.ajax.php",
  deferRender: true,
  retrieve: true,
  processing: true,
  language: {
    sProcessing: "Procesando...",
    sLengthMenu: "Mostrar _MENU_ registros",
    sZeroRecords: "No se encontraron resultados",
    sEmptyTable: "Ningún dato disponible en esta tabla",
    sInfo: "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
    sInfoEmpty: "Mostrando registros del 0 al 0 de un total de 0",
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
      =  Capturando la categoria para asignar el codigo dinamico. =
      =============================================*/

$("#nuevaCategoria").change(function () {
  var idCategoria = $(this).val();

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/products.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
      // var nuevoCodigo = respuesta ["codigo"];
      // console.log("nuevoCodigo", nuevoCodigo);

      if (!respuesta) {
        var nuevoCodigo = idCategoria + "001";
        $("#nuevoCodigo").val(nuevoCodigo);
      } else {
        var nuevoCodigo = Number(respuesta["codigo"]) + 1;
        $("#nuevoCodigo").val(nuevoCodigo);
      }
    },
  });
});

      /*========================================
      =  Agragando el precio de vent, que se calcule
       deacuerdo al % que esta en la ventana modal. =
      =============================================*/

$("#nuevoPrecioCompra, #editarPrecioCompra").change(function(){

        if($(".porcentaje").prop("checked")){

        var valorPorcentaje = $(".nuevoPorcentaje").val();
        // Formula para calcular el porcentaje.
        var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());

        var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
        // console.log("porcentaje", porcentaje);

        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly",true);

        $("#editarPrecioVenta").val(editarPorcentaje);
		    $("#editarPrecioVenta").prop("readonly",true);

    }

    
});

      /*========================================
      =  Cambio de porcentaje, por si la persona
       desea colocar el porcentaje que quiera. =
      =============================================*/

      $(".nuevoPorcentaje").change(function(){

        if($(".porcentaje").prop("checked")){

          var valorPorcentaje = $(".nuevoPorcentaje").val();
          // Formula para calcular el porcentaje.
          var porcentaje = Number(($("#nuevoPrecioCompra").val()*valorPorcentaje/100))+Number($("#nuevoPrecioCompra").val());
  
          var editarPorcentaje = Number(($("#editarPrecioCompra").val()*valorPorcentaje/100))+Number($("#editarPrecioCompra").val());
          // console.log("porcentaje", porcentaje);
  
          $("#nuevoPrecioVenta").val(porcentaje);
          $("#nuevoPrecioVenta").prop("readonly",true);
  
          $("#editarPrecioVenta").val(editarPorcentaje);
          $("#editarPrecioVenta").prop("readonly",true);
  
      }

  
      });


      /*========================================
      = para interactuar con el tema del porcentaje, 
        es decir que si a determinado precio le suma 
        el porcentaje y aun se requiere subirle mas
        el precio se puede dehabilitar el cheking y
        cambiar, sin afectar el sistema. =
      =============================================*/
      

      $(".porcentaje").on("ifUnchecked",function(){

        $("#nuevoPrecioVenta").prop("readonly",false);
        $("#editarPrecioVenta").prop("readonly",false);
      
      });
      
      $(".porcentaje").on("ifChecked",function(){
      
        $("#nuevoPrecioVenta").prop("readonly",true);
        $("#editarPrecioVenta").prop("readonly",true);
      
      });