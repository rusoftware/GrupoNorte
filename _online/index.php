<?php
include("./Admin/Conexion.inc.php");
include("./Admin/Funciones/Funciones.inc.php");

$pagina='home';

?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="es">
<!--<![endif]-->
<head>
   
   <!-- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
   <title>Grupo Norte | Rosario</title>
   <meta name="description" content="Grupo Norte | Rosario">
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
      <div class="col-sm-8">
         <div class="gallery_slides flexslider">
            <ul class="slides">
               <?php
               $cSql = "SELECT * FROM SliderHome WHERE SliVisible='Si' ORDER BY SliOrden ASC LIMIT 0,3";
               $aResultado = mysql_query($cSql) or die($error_consulta);
               while($aRegistro = mysql_fetch_array($aResultado)){ 
                  //$link = "nota/".$aRegistro['NovCodigo']."/".fUrlsAmigables($aRegistro['NovTitulo']).".html";
                  $enlace = addhttp($aRegistro["SliLink"]);
               ?>

                  <li style="height: 490px; overflow:hidden">
                     <a class="link_image" href="<?php echo $enlace ?>" title="<?php echo $aRegistro["SliTitulo"] ?>" target="_blank" style="height: 490px; overflow:hidden"><img src="./Upload/Directos/SliderHome/<?php echo $aRegistro["SliImagen"] ?>" alt="<?php echo $aRegistro["SliAlt"] ?>"/></a>
                     <div class="flex-caption">
                        <h2 class="post-title"><a class="link_image" href="<?php echo $enlace ?>" title="Permalink to <?php echo $aRegistro["SliTitulo"] ?>"><?php echo $aRegistro["SliTitulo"] ?></a></h2>
                        <p><?php echo $aRegistro["SliTexto"] ?></p>
                        <p><a class="readmore" href="<?php echo $enlace ?>" target="_blank">Leer Más</a></p>
                     </div>
                  </li>

               <? } ?>
               
            </ul> <!-- end slides -->
         </div> <!-- end gallery slider -->
      </div> <!-- end col-sm-8 -->
      <div class="col-sm-4">
         <div class="teaser-box2">
            <img src="./images/gn_banner_353-320.jpg" alt="Grupo Norte">
            <div class="content-wrapper">
               <a href="#">
                  <h5 style="background-color:#1e73be">Saber más</h5>
                  <h2><strong>Grupo Norte</strong></h2>
               </a>
               <p>Integrado por empresarios que viven o tiene sus empresas en la zona norte de Rosario.</p>
               <div class="line"></div>
            </div>
         </div>
      </div> <!-- end col-sm-4 -->


      <div class="col-sm-8">
         <hr class="vertical-space2">
         <div class="col-sm-6">
            <div class="latest-cat">
               
               <?php 
               $cSql = "SELECT ProCodigo, Proyectos.CatCodigo, CatNombre, ProTitulo, ProImagen, ProObjetivos FROM Proyectos LEFT JOIN Categorias ON Proyectos.CatCodigo = Categorias.CatCodigo WHERE ProVisible='Si' AND (Proyectos.CatCodigo='1' OR Proyectos.CatCodigo='3' OR Proyectos.CatCodigo='5') AND (ProFechaDesde<=NOW() OR ProFechaDesde='0000-00-00') AND (ProFechaHasta>=NOW() OR ProFechaHasta='0000-00-00') ORDER BY ProFechaInicio ASC LIMIT 0,4";
               $cResultado = mysql_query($cSql) or die(mysql_error());
               $i = 0;
               
               while( $aRegistro = mysql_fetch_array($cResultado) ){

                  $link = "proyecto/".$aRegistro["ProCodigo"]."/".fUrlsAmigables($aRegistro['ProTitulo']).".html";
                  if ($i==0) {
               ?>
                     <div class="sub-content">
                        <h6 class="h-sub-content"><?php echo $aRegistro["CatNombre"] ?></h6>
                     </div>
                     <article class="blog-post lc-main clearfix">
                        <figure>
                           <a href="<?php echo $link ?>"><img src="./Upload/Directos/Proyectos/<?php echo $aRegistro["ProImagen"] ?>" alt="<?php echo $aRegistro["ProTitulo"] ?>"/></a>
                        </figure>
                        <h4><a href="<?php echo $link ?>"><?php echo $aRegistro["ProTitulo"] ?></a></h4>
                        <p class="blog-author">   
                           <!--<strong>by</strong> Jane Smith <strong>in</strong> --><a href="proyectos/<?php echo $aRegistro['CatCodigo'] ?>/<?php echo fUrlsAmigables($aRegistro['CatNombre']) ?>.html" rel="category"><?php echo $aRegistro["CatNombre"] ?></a>                                  
                        </p>
                        <p class="blog-detail"><?php echo $aRegistro["ProObjetivos"] ?> <br><br><a class="readmore" href="<?php echo $link ?>">Leer Más</a></p>
                     </article>
                     <div class="lc-items">
               <? } else { ?>
                        <article class="blog-line clearfix">
                           <a href="<?php echo $link ?>" class="img-hover"><img src="./Upload/Directos/Proyectos/<?php echo $aRegistro["ProImagen"] ?>" alt="<?php echo $aRegistro["ProTitulo"] ?>" class="Thumbnail lfb_thumb " /></a>
                           <h4><a href="<?php echo $link ?>"><?php echo $aRegistro["ProTitulo"] ?></a></h4>
                           <p class="blog-author">
                              <?php echo fFormatoFecha($aRegistro["ProFechaDesde"], "dd MM aaaa"); ?> 
                              /
                              <strong>en <?php echo $aRegistro["CatNombre"] ?></strong>               
                           </p>
                        </article>
               <? }
                  $i++;
               } ?>
                     </div>
            </div> <!-- end latest-cat -->
         </div> <!-- end col-sm-6 -->

         <div class="col-sm-6">
            <div class="latest-cat">
               <?php 
               $cSql = "SELECT ProCodigo, Proyectos.CatCodigo, CatNombre, ProTitulo, ProImagen, ProDescripcion, ProFechaDesde, ProObjetivos FROM Proyectos LEFT JOIN Categorias ON Proyectos.CatCodigo = Categorias.CatCodigo WHERE ProVisible='Si' AND (Proyectos.CatCodigo='2' OR Proyectos.CatCodigo='4' OR Proyectos.CatCodigo='6') AND (ProFechaDesde<=NOW() OR ProFechaDesde='0000-00-00') AND (ProFechaHasta>=NOW() OR ProFechaHasta='0000-00-00') ORDER BY ProFechaInicio DESC LIMIT 0,4";
               $cResultado = mysql_query($cSql) or die(mysql_error());
               $i = 0;
               
               while( $aRegistro = mysql_fetch_array($cResultado) ){

                  $link = "proyecto/".$aRegistro["ProCodigo"]."/".fUrlsAmigables($aRegistro['ProTitulo']).".html";
                  if ($i==0) {
               ?>
                     <div class="sub-content">
                        <h6 class="h-sub-content"><?php echo $aRegistro["CatNombre"] ?></h6>
                     </div>
                     <article class="blog-post lc-main clearfix">
                        <figure>
                           <a href="<?php echo $link ?>"><img src="./Upload/Directos/Proyectos/<?php echo $aRegistro["ProImagen"] ?>" alt="<?php echo $aRegistro["ProTitulo"] ?>"/></a>
                        </figure>
                        <h4><a href="<?php echo $link ?>"><?php echo $aRegistro["ProTitulo"] ?></a></h4>
                        <p class="blog-author">   
                           <!--<strong>by</strong> Jane Smith <strong>in</strong> --><a href="proyectos/<?php echo $aRegistro['CatCodigo'] ?>/<?php echo fUrlsAmigables($aRegistro['CatNombre']) ?>.html" rel="category"><?php echo $aRegistro["CatNombre"] ?></a>                                  
                        </p>
                        <p class="blog-detail"><?php echo $aRegistro["ProObjetivos"] ?> <br><br><a class="readmore" href="<?php echo $link ?>">Leer Más</a></p>
                     </article>
                     <div class="lc-items">
               <? } else { ?>
                        <article class="blog-line clearfix">
                           <a href="<?php echo $link ?>" class="img-hover"><img src="./Upload/Directos/Proyectos/<?php echo $aRegistro["ProImagen"] ?>" alt="<?php echo $aRegistro["ProTitulo"] ?>" class="Thumbnail lfb_thumb " /></a>
                           <h4><a href="<?php echo $link ?>"><?php echo $aRegistro["ProTitulo"] ?></a></h4>
                           <p class="blog-author">
                              <?php echo fFormatoFecha($aRegistro["ProFechaDesde"], "dd MM aaaa"); ?> 
                              /
                              <strong>en <?php echo $aRegistro["CatNombre"] ?></strong>
                           </p>
                        </article>
               <?php }
                  $i++;
               } ?>
                     </div>
            </div>
         </div> <!-- end col-sm-6 -->



         <div class="col-sm-12 wt-grid">
            <hr class="vertical-space3">

            <?php //novedades
               $cSql = "SELECT * FROM Novedades WHERE NovVisible='Si' AND (NovFechaDesde<=NOW() OR NovFechaDesde='0000-00-00') AND (NovFechaHasta>=NOW() OR NovFechaHasta='0000-00-00') ORDER BY NovFechaDesde DESC LIMIT 0,3";
               $aResultado = mysql_query($cSql) or die($error_consulta);
               $i = 0;
               while($aRegistro = mysql_fetch_array($aResultado)){ 
                  $link = "nota/".$aRegistro['NovCodigo']."/".fUrlsAmigables($aRegistro['NovTitulo']).".html";
                  if($i==0){
               ?>

                  <div class="post-thumb">
                     <a href="<?php echo $link ?>" class="link_image" title="Permalink to <?php echo $aRegistro['NovTitulo'] ?>"><img src="./Upload/Directos/Novedades/<?php echo $aRegistro["NovImagen"] ?>" alt="<?php echo $aRegistro['NovTitulo'] ?>"/></a>
                  </div>
                  <h2 class="post-title">
                     <a href="<?php echo $link ?>" class="link_title" title="Permalink to <?php echo $aRegistro['NovTitulo'] ?>"><?php echo $aRegistro['NovTitulo'] ?></a>
                  </h2>
                  <div class="teaser-metadata">
                     <span class="author"><strong>Grupo Norte</strong></span>
                  </div>
                  <div class="teaser-metadata">
                     <span class="date"> el <strong><?php echo fFormatoFecha($aRegistro["NovFechaDesde"], "dd MM aaaa"); ?></strong></span>
                  </div>
                  <div class="teaser-metadata">
                     <span class="category">en <strong><a href="novedades.html" rel="category">Novedades</a></strong></span>
                  </div>
                  <div class="entry-content">
                     <?php echo $aRegistro["NovApostilla"] ?> <br /><br /><a class="readmore" href="<?php echo $link ?>">Leer Más</a>
                  </div>
                  <hr class="vertical-space4">
                  <hr class="vertical-space1">
               </div>
               <div class="clear"></div>
               <div class="title">
                  <h4>MÁS NOVEDADES</h4>
               </div>
               <div class="wt-grid">
                  <ul class="clearfix">
                  <!--<li>
                     <a class="link_image" href="<?php echo $link ?>" title="<?php echo $aRegistro["NovTitulo"] ?>"><img src="./Upload/Directos/Novedades/<?php echo $aRegistro["NovImagen"] ?>" alt=""/></a>
                     <div class="flex-caption">
                        <h6><a href="novedades.html" rel="category">Novedades</a> / <?php echo fFormatoFecha($aRegistro["NovFechaDesde"], "dd MM aaaa"); ?></h6>
                        <h2 class="post-title"><a class="link_image" href="<?php echo $link ?>" title="Permalink to <?php echo $aRegistro["NovTitulo"] ?>"><?php echo $aRegistro["NovTitulo"] ?></a></h2>
                        <p><?php echo $aRegistro["NovApostilla"] ?> in&#8230; </p>
                        <p><a class="readmore" href="<?php echo $link ?>">Read More</a></p>
                     </div>
                  </li>-->
                  <?php } else { ?>
                     <li class="col-sm-6">
                        <div class="post-thumb">
                           <a href="<?php echo $link ?>" class="link_image" title="Permalink to <?php echo $aRegistro["NovTitulo"] ?>"><img src="./Upload/Directos/Novedades/<?php echo $aRegistro["NovImagen"] ?>" alt="<?php echo $aRegistro["NovTitulo"] ?>" /></a>
                        </div>
                        <h2 class="post-title">
                           <a href="<?php echo $link ?>" class="link_title" title="Permalink to <?php echo $aRegistro["NovTitulo"] ?>"><?php echo $aRegistro["NovTitulo"] ?></a>
                        </h2>
                        <div class="teaser-metadata">
                           <span class="date"> el <strong><?php echo fFormatoFecha($aRegistro["NovFechaDesde"], "dd MM aaaa"); ?></strong></span>
                        </div>
                        <div class="teaser-metadata">
                           <span class="author">por <strong>Grupo Norte</strong></span>
                        </div>
                        <div class="teaser-metadata">
                           <span class="category">en <strong><a href="novedades.html" rel="category">Novedades</a></strong></span>
                        </div>
                        <div class="entry-content">
                           <?php echo $aRegistro["NovApostilla"] ?> <br /><br /><a class="readmore" href="<?php echo $link ?>">Leer Más</a>
                        </div>
                     </li>
                  <?php }
                  $i++ ?>

               <?php } ?>
            </ul>
            <hr class="vertical-space3">
         </div>
         <div class="clear"></div>
         <!--
         <div class="title">
            <h4>WILD LIFE</h4>
         </div>
         <div class="container">
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba19.png" alt="Fastest Cat" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Fastest Cat</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba03.jpg" alt="Aggressive Killer Crows" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Aggressive Killer Crows</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba05.jpg" alt="Extinct creature discovered" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Extinct creature discovered</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba07.jpg" alt="Wild Goose Chase" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Wild Goose Chase</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba01.jpg" alt="Aggressive Killer Hawk" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Aggressive Killer Hawk</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
            <div class="col-md-6">
               <article class="latest-b2">
                  <figure class="latest-b2-img"><img src="./images/yakisoba/yakisoba08.jpg" alt="Typical Tree Squirrel" /></figure>
                  <div class="latest-b2-cont">
                     <h6 class="latest-b2-cat"><a href="#" rel="category">Wild Life</a></h6>
                     <h3 class="latest-b2-title"><a href="single.html">Typical Tree Squirrel</a></h3>
                     <h5 class="latest-b2-date">Jane Smith / Feb 25, 2014</h5>
                  </div>
               </article>
            </div>
         </div>--> <!-- end container -->
      </div> <!-- end col-sm-8 -->

      <div class="col-sm-4">
         <?php include_once('inc.sidebar.php') ?>
      </div>
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
	
   
  
</body>
</html>