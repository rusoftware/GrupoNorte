<?php
include("./Admin/Conexion.inc.php");
include("./Admin/Funciones/Funciones.inc.php");

$pagina = 'single';
?>
<!DOCTYPE html>
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="es">
<!--<![endif]-->
<head>
   
   <!-- Basic Page Needs
   ================================================== -->
   <meta charset="utf-8">
   <title>Grupo Norte | Quienes Somos</title>
   <meta name="description" content="Grupo Norte - quienes somos">
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
      <section class="col-md-12 omega ">
         <article class="blog-single-post">
            <img src="./images/yakisoba/yakisoba35.jpg" alt="Cast away for 10 years"/>
            <div class="post">
               <div class="postmetadata">
                  <div class="au-avatar"><img src='./images/yakisoba/avatar1.jpg' alt=""/></div>
                  <h6 class="blog-author"><strong>by</strong> Jane Smith </h6>
                  <h6 class="blog-cat"><strong>in</strong> <a href="#" rel="category">Stories</a> </h6>
               </div>
               <h6 class="blog-date"><span>25 </span>Feb 2014 </h6>
               <h1>Cast away for 10 years</h1>
               <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed tortor augue, volutpat vel malesuada eu, dapibus vulputate tortor. Curabitur accumsan, justo ac malesuada cursus, magna arcu pretium ante, placerat venenatis est leo ut dui. Quisque vehicula imperdiet urna ultrices suscipit. Donec at odio sed odio ultrices tempor. Nullam quis iaculis est. Vivamus a urna sapien. Suspendisse vel lectus imperdiet, dignissim arcu id, ultricies est. Sed tincidunt congue ante ac accumsan. Fusce in massa augue. Proin a orci tincidunt, venenatis est eu, auctor lacus. Nam molestie augue orci, nec consequat nulla egestas eget. Nunc lorem nibh, hendrerit sed tincidunt quis, egestas eu nibh. Pellentesque at diam tincidunt, sodales ipsum ac, elementum sem. Duis at odio id urna hendrerit sollicitudin in sed augue. Proin et leo nisl. Mauris feugiat ultricies tincidunt.</p>
               <p>Nulla gravida, lectus in tempus fermentum, lorem nibh dictum turpis, sollicitudin imperdiet nisi lorem tempor est. Etiam ut convallis lacus, eu lacinia lectus. Quisque a orci in nunc interdum dignissim in vitae turpis. Vestibulum nulla purus, semper ac tempus et, fringilla vitae lacus. Fusce consectetur euismod libero vel interdum. Proin in interdum mauris. Morbi faucibus sit amet justo malesuada mollis. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Vivamus in leo sed mi scelerisque consequat eget et lectus. Donec posuere luctus sem, posuere rutrum magna interdum in.</p>
               <p>Cras faucibus ligula interdum nulla semper, et interdum massa auctor. Etiam tempus semper nisl vitae tempor. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Etiam pharetra diam et adipiscing bibendum. Aliquam mattis diam nulla, nec scelerisque urna scelerisque at. Morbi lacus enim, blandit ut dolor quis, commodo sodales nisl. Pellentesque quam orci, eleifend sed mi non, fringilla scelerisque elit. Duis sed libero ligula. Cras non nisl turpis.</p>
               <br class="clear">
               <div class="post-tags">
                  <i class="fa-tags"></i> &nbsp; Tags: <a href="#" rel="tag">quick</a>        
               </div>
               <!-- End Tags -->
               <div class="next-prev-posts">
               </div>
               <!-- End next-prev post -->
               <div class="about-author-sec">
                  <img src='./images/yakisoba/avatar1.jpg' alt=""/>      
                  <h5>Jane Smith</h5>
                  <p></p>
               </div>
            </div>
         </article>
      </section>
      <!-- end-main-conten -->

      
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