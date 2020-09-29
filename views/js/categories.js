/*========================================
  =  Editar Categoria.  =
  =============================================*/

$(".tablas").on("click", ".btnEditarCategoria", function () {

  var idCategoria = $(this).attr("idCategoria");

  var datos = new FormData();
  datos.append("idCategoria", idCategoria);

  $.ajax({
    url: "ajax/categories.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {
        // console.log("respuesta", respuesta);
      $("#editarCategoria").val(respuesta["nombre_cat"]);
      $("#idCategoria").val(respuesta["id"]);
    },
  });
});
