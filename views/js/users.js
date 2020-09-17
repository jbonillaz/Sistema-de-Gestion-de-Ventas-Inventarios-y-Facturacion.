/*========================================
  =        Subiendo la foto del usuario
  a la tabal de usuarios     =
  =============================================*/

  $(".nuevaFoto").change(function(){

    var imagen = this.files[0];
    
    /*========================================
  =        Validamos el formato de la imagen    =
  =============================================*/
  if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png"){
      
    $(".nuevaFoto").val("");

      swal({
        title: "Error al subir la imagen",
        text: "¡La imagen debe estar en formato JPG o PNG!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

  }else if(imagen["size"] > 2000000){

    $(".nuevaFoto").val("");

     swal({
        title: "Error al subir la imagen",
        text: "¡La imagen no debe pesar más de 2MB!",
        type: "error",
        confirmButtonText: "¡Cerrar!"
      });

}else{

    var datosImagen = new FileReader;
    datosImagen.readAsDataURL(imagen);

    $(datosImagen).on("load", function(event){

        var rutaImagen = event.target.result;

        $(".previsualizar").attr("src", rutaImagen);

    });

}

  });