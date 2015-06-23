<?php
include("./Admin/Conexion.inc.php");
include("./Admin/Funciones/Funciones.inc.php");

$pagina='proyecto';

if(fValidarVar($_GET["pid"])!=''){
   $id = fValidarVar($_GET["pid"]);

$cSql = "SELECT ProCodigo, Proyectos.CatCodigo, CatNombre, ProTitulo, ProObjetivos, ProImagen, ProDescripcion, ProFechaInicio, ProFechaFin, ProVisitas FROM Proyectos LEFT JOIN Categorias ON Proyectos.CatCodigo = Categorias.CatCodigo WHERE ProVisible='Si' AND ProCodigo = '". $id ."'";
$cResultado = mysql_query($cSql) or die('Se ha producido un error');

  if(mysql_num_rows($cResultado)!=0){
    $aRegistro = mysql_fetch_array($cResultado);
    fContarVisitas('Proyectos', 'Pro', $id);
  }else{
    header("Location: http://www.gruponorte.org.ar/proyectos.html");
  }

} else {
  header("Location: http://www.gruponorte.org.ar/proyectos.html");
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
   <title>Grupo Norte | <?php echo $aRegistro["ProTitulo"]; ?></title>
   <meta name="description" content="<?php echo $aRegistro["ProObjetivos"]; ?>">
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
            <img src="./Upload/Directos/Proyectos/<?php echo $aRegistro["ProImagen"] ?>" alt="<?php echo $aRegistro['ProTitulo'] ?>"/>
            <div class="post">
               <div class="postmetadata">
                  <h6 class="blog-cat"><strong>en</strong> <a href="#" rel="category"><?php echo $aRegistro['CatNombre'] ?></a> </h6>
               </div>
               <h6 class="blog-date"><?php echo fFormatoFecha($aRegistro["ProFechaInicio"], "<span>dd</span> MM aaaa"); ?> </h6>
               <h1><?php echo $aRegistro['ProTitulo'] ?></h1>
               <h3>Objetivos del proyecto</h3>
               <?php echo $aRegistro['ProObjetivos'] ?>
               <p>&nbsp;</p>
               <h3>Descripción</h3>
               <p><?php echo $aRegistro['ProDescripcion'] ?></p>
               <br class="clear">
               <div class="post-tags">
                  <i class="fa-tags"></i> &nbsp; Tags: <a href="#" rel="tag"><?php echo fUrlsAmigables($aRegistro['ProTitulo']) ?></a> <a href="#" rel="tag"><?php echo fUrlsAmigables($aRegistro['CatNombre']) ?></a>
               </div>
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