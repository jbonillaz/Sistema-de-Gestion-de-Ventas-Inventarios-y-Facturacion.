<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Sales System LIROZ</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

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
  

</head>

<!--========================================
  =         Documents Body          =
  =============================================-->
<body class="hold-transition skin-blue sidebar-collapse sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  
<?php
/*========================================
  =         Include for bigheader          =
  =============================================*/
include "modulos/cabezote.php";

/*========================================
  =         Include for menu         =
  =============================================*/
include "modulos/menu.php";

/*========================================
  =         Include for menu         =
  =============================================*/
  include "modulos/contenido.php";

  /*========================================
  =         Include for footer        =
  =============================================*/

  include "modulos/footer.php";
?>
  
  
</div>
<!-- ./wrapper -->
<script src="views/js/template.js"></script>
</body>
</html>
