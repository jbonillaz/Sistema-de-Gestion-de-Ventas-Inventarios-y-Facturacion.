/*========================================
  =  Editar Cliente.  =
  =============================================*/

  $(".tablas").on("click", ".btnEditarCliente", function(){

    var idCliente = $(this).attr("idCliente");

    var datos = new FormData();
    datos.append("idCliente", idCliente);


    $.ajax({
        url:"ajax/clients.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType:"json",
      success:function(respuesta){
    
        //  console.log("respuesta", respuesta);
        $("#idCliente").val(respuesta["id"]); //es para poder hacer las validacioines en la edicion.
        $("#editarCliente").val(respuesta["nombre"]);
        $("#editarDocumentoId").val(respuesta["documento"]);
        $("#editarEmail").val(respuesta["email"]);
        $("#editarTelefono").val(respuesta["telefono"]);
        $("#editarDireccion").val(respuesta["direccion"]);
        $("#editarFechaNacimiento").val(respuesta["fecha_nacimiento"]);

      }
    
    });


  });