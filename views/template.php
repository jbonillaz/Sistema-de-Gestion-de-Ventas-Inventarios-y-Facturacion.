<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales System LIROZ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="views/img/template/icono-negro.png">
  
  <!--========================================
  =         Plugin of CSS          =
  =============================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="views/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="views/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="views/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="views/dist/css/AdminLTE.css">
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="views/dist/css/skins/_all-skins.min.css">
  
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="views/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">
  
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="views/plugins/iCheck/all.css">
  
  <!--========================================
  =         Pluygins of JavaScrip          =
  =============================================-->
  

  <!-- jQuery 3 -->
  <script src="views/bower_components/jquery/dist/jquery.min.js"></script>
  <!-- Bootstrap 3.3.7 -->
  <script src="views/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  <!-- SlimScroll -->
  <script src="views/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
  <!-- FastClick -->
  <script src="views/bower_components/fastclick/lib/fastclick.js"></script>
  <!-- AdminLTE App -->
  <script src="views/dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="views/dist/js/demo.js"></script>
  <!-- DataTables -->
  <script src="views/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
  <script src="views/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script>
  <!-- SweetAlert 2 -->
  <script src="views/plugins/sweetalert2/sweetalert2.all.js"></script>

  <!-- El siguiente pliguin o complemento me soluciona el tema de las alertas suaves de Swal en el navegador internet explorer -->
  <!-- By default SweetAlert2 doesn't support IE. To enable IE 11 support, include Promise polyfill:-->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

  <!-- iCheck 1.0.1 -->
  <script src="views/plugins/iCheck/icheck.min.js"></script>


</head>

<!--========================================
  =         Documents Body          =
  =============================================-->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini login-page">
<!-- Site wrapper -->

<?php

 if(isset($_SESSION["login"]) && $_SESSION["login"] == "ok"){

  echo '<div class="wrapper">';

/*========================================
  =         Include for bigheader          =
  =============================================*/
include "modulos/cabezote.php";

/*========================================
  =         Include for menu         =
  =============================================*/
include "modulos/menu.php";

/*===============================================
  =  Vistas, los controladores y los modelos,
  de esta manera se configuran las vistas para el 
  sistema general.=
  =============================================*/
  if(isset($_GET["ruta"])){

    if($_GET["ruta"] == "inicio" ||
       $_GET["ruta"] == "usuarios" ||
       $_GET["ruta"] == "categorias" ||
       $_GET["ruta"] == "productos" ||
       $_GET["ruta"] == "clientes" ||
       $_GET["ruta"] == "ventas" ||
       $_GET["ruta"] == "crear-venta" ||
       $_GET["ruta"] == "reportes" ||
       $_GET["ruta"] == "salir"){

      include "modulos/".$_GET["ruta"].".php";
    /**En caso de no encontrar ninguna de las vistas */
    }else{

      include "modulos/404.php";

    }

  }else{

    include "modulos/inicio.php";

  }


  /*========================================
  =         Include for footer        =
  =============================================*/

  include "modulos/footer.php";

  echo '</div>';

  }else{

    include "modulos/login.php";

  }
?>
<!-- ./wrapper -->
<script src="views/js/template.js"></script>
<script src="views/js/users.js"></script>
<script src="views/js/categories.js"></script>
<script src="views/js/products.js"></script>
</body>
</html>
