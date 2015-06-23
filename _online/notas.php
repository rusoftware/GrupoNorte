<?php
include("./Admin/Conexion.inc.php");
include("./Admin/Funciones/Funciones.inc.php");

$pagina='novedades';
?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="es">
<!--<![endif]-->
<head>
   
   <!-- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
   <title>Grupo Norte | Novedades</title>
   <meta name="description" content="Extent - another WordPress theme">
   <?php include_once('inc.metaTags.php') ?>
   
   <!-- CSS
   ================================================== -->
   <link rel="stylesheet" href="./css/style.css" type="text/css"  media="all">
   
   <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:300italic,400italic,400,300,600,700,900|Varela|Arapey:400,400italic' rel="stylesheet" type='text/css' >

   <!-- JS
   ================================================== -->
   <script src="./js/jquery.min.js" type="text/javascript"></script>
   <script src="./layerslider/js/greensock.js" type="text/javascript"></script>
   <!--[if lt IE 9]>
   <script src="./js/modernizr.custom.11889.js" type="text/javascript"></script>
   <script src="./js/respond.js" type="text/javascript"></script>
   <![endif]-->
   <!-- HTML5 Shiv events (end)-->
   <!-- MEGA MENU -->
   
   <!-- Favicons
   ================================================== -->
   <link rel="shortcut icon" href="./images/favicon.ico">

</head>
<body>

<!-- Primary Page Layout
================================================== -->
<div id="wrap" class="boxed-wrap">

   <?php include_once("inc.header.php"); ?>

   <!-- Start Page Content -->
   <section id="headline">
      <div class="container">
         <h3>Novedades</h3>
      </div>
   </section>


   <section id="main-content" class="container">

      <hr class="vertical-space2">
      <!-- begin-main-content -->
      <section class="col-md-8 omega">
         <?php 
         $cSql = "SELECT * FROM Novedades WHERE NovVisible='Si' AND (NovFechaDesde<=NOW() OR NovFechaDesde='0000-00-00') AND (NovFechaHasta>=NOW() OR NovFechaHasta='0000-00-00') ORDER BY NovFechaDesde DESC";
               $aResultado = mysql_query($cSql) or die($error_consulta);
               $i = 0;
               while ( $aRegistro = mysql_fetch_array($aResultado) ) { 
                  $link = "nota/".$aRegistro['NovCodigo']."/".fUrlsAmigables($aRegistro['NovTitulo']).".html";
         ?>
         <article class="blog-post">
            <div class="col-md-6 alpha omega"> 
               <img src="./Upload/Directos/Novedades/<?php echo $aRegistro["NovImagen"] ?>" alt="<?php echo $aRegistro['NovTitulo'] ?>" />
               <br>
            </div>
            <div class="col-md-6 omega">
               <!--<div class="postmetadata">
                  <div class="au-avatar"><img src='./images/yakisoba/avatar1.jpg' alt=""/></div>
                  <h6 class="blog-author"><strong>by</strong> Jane Smith </h6>
                  <h6 class="blog-cat"><strong>in</strong> <a href="#" rel="category">Entertainment</a> </h6>
               </div>-->
               <h6 class="blog-date" style="margin-top: 6px; padding-top: 4px; ">
                  <?php echo fFormatoFecha($aRegistro["NovFechaDesde"], "<span>dd</span> MM aaaa"); ?> 
               </h6>
               <div class="postmetadata tp2sec">
                  <h6 class="blog-views"> <i class="fa-eye"></i><span><?php echo $aRegistro['NovVisitas'] ?></span> </h6>
               </div>
               <h3><a href="<?php echo $link ?>"><?php echo $aRegistro['NovTitulo'] ?></a></h3>
               <p><?php echo $aRegistro["NovApostilla"] ?> <br><br><a class="readmore" href="<?php echo $link ?>">Leer Más</a></p>
            </div>
            <br class="clear">
         </article>
         <?php } ?>
         
         <br class="clear">
         <div class="vertical-space3"></div>
      </section>
      <!-- end-main-content -->

      <div class="col-md-3 col-md-offset-1">
      <?php include_once('inc.sidebar.php') ?>
      <hr class="vertical-space4">
      <hr class="vertical-space1">
   </section>

   <!-- Footer -->
   <?php include_once("inc.footer.php"); ?>
   <!-- end footer -->
  
   <span id="scroll-top"><a class="scrollup"><i class="fa-chevron-up"></i></a></span>
   
</div> <!-- end Wrap -->

   <!-- End Document
   ================================================== -->

   <!-- JS
   ================================================== -->
   <script src="./js/jquery.plugins.js" type="text/javascript"></script>
   <script src="./js/jquery.masonry.min.js" type="text/javascript"></script>
   <script src="./js/mediaelement-and-player.min.js" type="text/javascript"></script>
   <script src="./js/isotope.js" type="text/javascript"></script>
   <script src="./layerslider/js/layerslider.transitions.js" type="text/javascript"></script>
   <script src="./layerslider/js/layerslider.kreaturamedia.jquery.js" type="text/javascript"></script>
   <script src="./js/jquery.jcarousel.min.js" type="text/javascript"></script>
   <script src="./js/extent-custom.js" type="text/javascript"></script>
	
   
  
</body>
</html>