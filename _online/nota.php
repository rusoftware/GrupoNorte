<?php
include("./Admin/Conexion.inc.php");
include("./Admin/Funciones/Funciones.inc.php");

$pagina = 'nota';
$id = $_GET['id'];

if(fValidarVar($_GET["nid"])!=''){
   $id = fValidarVar($_GET["nid"]);

$cSql = "SELECT * FROM Novedades WHERE NovVisible='Si' AND NovCodigo = '". $id ."'";
$cResultado = mysql_query($cSql) or die('Se ha producido un error');

  if(mysql_num_rows($cResultado)!=0){
    $aRegistro = mysql_fetch_array($cResultado);
    fContarVisitas('Novedades', 'Nov', $id);
  }else{
    header("Location: http://www.gruponorte.org.ar/novedades.html");
  }

} else {
  header("Location: http://www.gruponorte.org.ar/novedades.html");
}

?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="es">
<!--<![endif]-->
<head>
   
   <!-- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
   <title>Grupo Norte | <?php echo $aRegistro["NovTitulo"]; ?></title>
   <meta name="description" content="<?php echo $aRegistro["NovApostilla"]; ?>">
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
   <section id="main-content" class="container">
      <hr class="vertical-space2">
      <section class="col-md-8 omega ">
         <article class="blog-single-post">
            <img src="./Upload/Directos/Novedades/<?php echo $aRegistro["NovImagen"] ?>" alt="<?php echo $aRegistro['NovTitulo'] ?>" />
            <div class="post">
               <h6 class="blog-date">
                  <?php echo fFormatoFecha($aRegistro["NovFechaDesde"], "<span>dd</span> MM aaaa"); ?> 
               </h6>
               <div class="postmetadata tp2sec" style="float:right">
                  <h6 class="blog-views"> <i class="fa-eye"></i><span><?php echo $aRegistro['NovVisitas'] +1  ?></span> </h6>
               </div>

               <h1><?php echo $aRegistro["NovTitulo"]; ?></h1>
               <p><?php echo $aRegistro["NovTexto"]; ?></p>
               <br class="clear">
               <!--<div class="post-tags">
                  <i class="fa-tags"></i> &nbsp; Tags: <a href="#" rel="tag">quick</a>        
               </div>-->
               <!-- End Tags -->
               <div style="text-align: right; border-top: solid 3px #ddd; padding-top: 12px;"><div class="addthis_sharing_toolbox"></div></div>
               <!-- End next-prev post -->
               <!--
               <div class="about-author-sec">
                  <img src='./images/yakisoba/avatar1.jpg' alt=""/>      
                  <h5>Jane Smith</h5>
                  <p></p>
               </div>-->
            </div>
         </article>
      </section>
      <!-- end-main-conten -->

      <div class="col-md-3 col-md-offset-1">
      <?php include_once('inc.sidebar.php') ?>
      <hr class="vertical-space4">
      <hr class="vertical-space1">
   </section>

   <!-- Footer -->
   <?php include_once("inc.footer.php") ?>
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
	
   <!-- Go to www.addthis.com/dashboard to customize your tools -->
   <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-507755fa38e1558e" async="async"></script>


  
</body>
</html>