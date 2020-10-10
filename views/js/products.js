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

$("#nuevoPrecioCompra, #editarPrecioCompra").change(function () {
  if ($(".porcentaje").prop("checked")) {
    var valorPorcentaje = $(".nuevoPorcentaje").val();
    // Formula para calcular el porcentaje.
    var porcentaje = Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) + Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) + Number($("#editarPrecioCompra").val());
    // console.log("porcentaje", porcentaje);

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

/*========================================
      =  Cambio de porcentaje, por si la persona
       desea colocar el porcentaje que quiera. =
      =============================================*/

$(".nuevoPorcentaje").change(function () {
  if ($(".porcentaje").prop("checked")) {

    // (this) es para que saque solo el porcentarje que se esta cambiando
    var valorPorcentaje = $(this).val();
    // Formula para calcular el porcentaje.
    var porcentaje =Number(($("#nuevoPrecioCompra").val() * valorPorcentaje) / 100) + Number($("#nuevoPrecioCompra").val());

    var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorPorcentaje) / 100) + Number($("#editarPrecioCompra").val());
    // console.log("porcentaje", porcentaje);

    $("#nuevoPrecioVenta").val(porcentaje);
    $("#nuevoPrecioVenta").prop("readonly", true);

    $("#editarPrecioVenta").val(editarPorcentaje);
    $("#editarPrecioVenta").prop("readonly", true);
  }
});

/*========================================
      = para interactuar con el tema del porcentaje, 
        es decir que si a determinado precio le suma 
        el porcentaje y aun se requiere subirle mas
        el precio se puede dehabilitar el cheking y
        cambiar, sin afectar el sistema. =
      =============================================*/

$(".porcentaje").on("ifUnchecked", function () {

  $("#nuevoPrecioVenta").prop("readonly", false);
  $("#editarPrecioVenta").prop("readonly", false);

});

$(".porcentaje").on("ifChecked", function () {

  $("#nuevoPrecioVenta").prop("readonly", true);
  $("#editarPrecioVenta").prop("readonly", true);

});

/*========================================
        =        Subiendo la foto del usuario
        a la tabal de usuarios     =
        =============================================*/

$(".nuevaImagen").change(function () {
  var imagen = this.files[0];

  /*========================================
  =        Validamos el formato de la imagen    =
  =============================================*/
  if (imagen["type"] != "image/jpeg" && imagen["type"] != "image/png") {
    $(".nuevaImagen").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen debe estar en formato JPG o PNG!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else if (imagen["size"] > 2000000) {
    $(".nuevaImagen").val("");

    swal({
      title: "Error al subir la imagen",
      text: "¡La imagen no debe pesar más de 2MB!",
      type: "error",
      confirmButtonText: "¡Cerrar!",
    });
  } else {
    var datosImagen = new FileReader();
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function (event) {
      var rutaImagen = event.target.result;

      $(".previsualizar").attr("src", rutaImagen);
    });
  }
});

/*========================================
  =        Editar producto   =
  =============================================*/

$(".tablaProductos tbody").on("click", "button.btnEditarProducto", function () {
  var idProducto = $(this).attr("idProducto");
  // console.log("idProducto", idProducto);
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
          var datosCategoria = new FormData();
          datosCategoria.append("idCategoria",respuesta["id_categoria"]);

           $.ajax({

              url:"ajax/categories.ajax.php",
              method: "POST",
              data: datosCategoria,
              cache: false,
              contentType: false,
              processData: false,
              dataType:"json",
              success:function(respuesta){
              // console.log("respuesta", respuesta);

                  $("#editarCategoria").val(respuesta["id"]);
                  $("#editarCategoria").html(respuesta["nombre_cat"]);

              }

          });

           $("#editarCodigo").val(respuesta["codigo"]);

           $("#editarDescripcion").val(respuesta["descripcion"]);

           $("#editarStock").val(respuesta["stock"]);

           $("#editarPrecioCompra").val(respuesta["precio_compra"]);

           $("#editarPrecioVenta").val(respuesta["precio_venta"]);

           if(respuesta["imagen"] != ""){

           	$("#imagenActual").val(respuesta["imagen"]);

           	$(".previsualizar").attr("src",  respuesta["imagen"]);

           }

      }

  });
});

/*========================================
  =        Eliminar producto   =
  =============================================*/

  $(".tablaProductos tbody").on("click", "button.btnEliminarProducto", function(){

    var idProducto = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    
    swal({
  
      title: '¿Está seguro de borrar el producto?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, borrar producto!'
          }).then(function(result){
          if (result.value) {
  
            window.location = "index.php?ruta=productos&idProducto="+idProducto+"&imagen="+imagen+"&codigo="+codigo;
  
          }
  
  
    });
  
  });
    
  

