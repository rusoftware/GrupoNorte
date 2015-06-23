         <hr class="vertical-space2">
         <div class="widget">
            <div class="widget-tabs">
               <div class="tab-hold tabs-wrapper">
                  <ul id="tabs" class="tabset tabs">
                     <li><a href="#tab-popular">Proyectos</a></li>
                     <li><a href="#tab-recent">Novedades</a></li>
                     <!--<li><a href="#tab-comments">Comments</a></li>-->
                  </ul>
                  <div class="tab-box tabs-container">
                     <div id="tab-popular" class="tab tab_content">
                        <ul class="tab-list">
                           <?php 
                           $pSql = "SELECT ProCodigo, ProTitulo, ProImagen, ProFechaInicio FROM Proyectos WHERE ProVisible='Si' AND (ProFechaDesde<=NOW() OR ProFechaDesde='0000-00-00') AND (ProFechaHasta>=NOW() OR ProFechaHasta='0000-00-00') ORDER BY ProVisitas DESC LIMIT 0,12";
                           $pResult = mysql_query($pSql) or die(mysql_error());
                           
                           while($pRegist = mysql_fetch_array($pResult)){

                              $linky = "proyecto/".$pRegist['ProCodigo']."/".fUrlsAmigables($pRegist['ProTitulo']).".html";

                           ?>
                           <li>
                              <div class="image">
                                 <a href="<?php echo $linky ?>" style="max-height:44px; overflow:hiden">
                                 <img src="./Upload/Directos/Proyectos/<?php echo $pRegist["ProImagen"] ?>" alt="<?php echo $pRegist['ProTitulo'] ?>" />
                                 </a>
                              </div>
                              <div class="content">
                                 <a href="<?php echo $linky ?>"><?php echo $pRegist['ProTitulo'] ?></a>
                                 <div class="tab-date">
                                    <?php echo fFormatoFecha($pRegist["ProFechaInicio"], "dd de MM, aaaa"); ?> 
                                 </div>
                              </div>
                           </li>

                           <?php  } ?>

                        </ul>
                     </div>
                     <div id="tab-recent" class="tab tab_content" style="display: none;">
                        <ul class="tab-list">
<!--
NovCodigo
NovTitulo
NovApostilla
NovTexto
NovFechaDesde
NovHoraDesde
NovFechaHasta
NovImagen
NovImgFuente
NovVisible
NovDateTime
NovVisitas
-->
                           <?php 
                           $nSql = "SELECT NovCodigo, NovTitulo, NovImagen, NovFechaDesde FROM Novedades WHERE NovVisible='Si' AND (NovFechaDesde<=NOW() OR NovFechaDesde='0000-00-00') AND (NovFechaHasta>=NOW() OR NovFechaHasta='0000-00-00') ORDER BY NovVisitas DESC LIMIT 0,12";
                           $nResult = mysql_query($nSql) or die(mysql_error());
                           
                           while($nRegist = mysql_fetch_array($nResult)){

                              $linko = "nota/".$nRegist['NovCodigo']."/".fUrlsAmigables($nRegist['NovTitulo']).".html";

                           ?>
                           <li>
                              <div class="image">
                                 <a href="<?php echo $linko ?>" style="max-height:44px; overflow:hiden">
                                 <img src="./Upload/Directos/Novedades/<?php echo $nRegist["NovImagen"] ?>" alt="<?php echo $nRegist['NovTitulo'] ?>" />
                                 </a>
                              </div>
                              <div class="content">
                                 <a href="<?php echo $linko ?>"><?php echo $nRegist['NovTitulo'] ?></a>
                                 <div class="tab-date">
                                    <?php echo fFormatoFecha($nRegist["NovFechaDesde"], "dd de MM, aaaa"); ?> 
                                 </div>
                              </div>
                           </li>

                           <?php  } ?>
                        </ul>
                     </div>
                     <div id="tab-comments" class="tab tab_content">
                        <ul class="tab-list">
                           <li>
                              <div class="image">
                                 <a>
                                 <img src='./images/yakisoba/avatar1.jpg' alt=""/>                           </a>
                              </div>
                              <div class="content">
                                 <p>Jane Smith says:</p>
                                 <div>
                                    <a class="comment-text-side" href="single.html" title="Jane Smith on Share your business plan information">commodo ligula eget dolor...</a>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="image">
                                 <a>
                                 <img src='./images/yakisoba/avatar1.jpg' alt=""/>                           </a>
                              </div>
                              <div class="content">
                                 <p>Jane Smith says:</p>
                                 <div>
                                    <a class="comment-text-side" href="single.html" title="Jane Smith on Recalling sweet memories from bridge">dolor sit amet...</a>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="image">
                                 <a>
                                 <img src='./images/yakisoba/avatar1.jpg' alt=""/>                           </a>
                              </div>
                              <div class="content">
                                 <p>Jane Smith says:</p>
                                 <div>
                                    <a class="comment-text-side" href="single.html" title="Jane Smith on Recalling sweet memories from bridge">lorem ipsum...</a>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="image">
                                 <a>
                                 <img src='./images/yakisoba/avatar2.png' alt=""/>                           </a>
                              </div>
                              <div class="content">
                                 <p>Jack Smith says:</p>
                                 <div>
                                    <a class="comment-text-side" href="single.html" title="Jack Smith on Famous sea cave conceptualize high-quality schemas">Vivamus eu accumsan erat...</a>
                                 </div>
                              </div>
                           </li>
                           <li>
                              <div class="image">
                                 <a>
                                 <img src='./images/yakisoba/avatar2.png' alt=""/>                           </a>
                              </div>
                              <div class="content">
                                 <p>Jack Smith says:</p>
                                 <div>
                                    <a class="comment-text-side" href="single.html" title="Jack Smith on Famous sea cave conceptualize high-quality schemas">Curabitur dignissim dui in ante interdum...</a>
                                 </div>
                              </div>
                           </li>
                        </ul>
                     </div>
                  </div>
               </div>
            </div>
         </div>

         <div class="widget">
         <hr class="vertical-space4">
            <h4 class="subtitle">Social</h4>
            <div class="socialfollow">
               <a href="#" class="twitter"><i class="fa-twitter"></i></a><a href="#" class="facebook"><i class="fa-facebook"></i></a><a href="#" class="youtube"><i class="fa-youtube"></i></a><a href="#" class="pinterest"><i class="fa-pinterest"></i></a><a href="#" class="vimeo"><i class="fa-vimeo-square"></i></a><a href="#" class="google"><i class="fa-google"></i></a><a href="#" class="instagram"><i class="fa-instagram"></i></a><a href="#" class="other-social"><i class="fa-flickr"></i></a>         
               <div class="clear"></div>
            </div>
         </div>

         <?php
            if($pagina == home) { ?>
            <!--
         <div class="widget">
         <hr class="vertical-space4">
            <h4 class="subtitle">Testimonial</h4>
            <div class="testimonial">
               <div class="testimonial-content">
                  <h4><q> Excellent template. One of the best theme I have ever used. Every minor detail has been taken care of. Clean, Modern Design can be used for any type of website. </q></h4>
                  <div class="testimonial-arrow"></div>
               </div>
               <div class="testimonial-brand">
                  <img src="./images/testimonials/man-q1.jpg" alt="Testimonial John Smith" />
                  <h5><strong>John Smith</strong><br><em>Manager at Mexin</em></h5>
               </div>
            </div>
         </div>-->
         <? } ?>

         <div class="widget">
            <h4 class="subtitle">Colaboran</h4>
            <div class="webnus-ad">
               <a href="http://themeforest.net/user/WEBNUS"><img src="./images/blog/ads.jpg" alt="" /></a>         
               <div class="clear"></div>
            </div>
         </div>
<!--
         <div class="widget">
         <hr class="vertical-space4">
            <h4 class="subtitle">Tags</h4>
            <div class="tagcloud">
               <a href='#'>animal</a>
               <a href='#'>Animation</a>
               <a href='#'>beach</a>
               <a href='#'>blog</a>
               <a href='#'>book</a>
               <a href='#'>cat</a>
               <a href='#'>flash</a>
               <a href='#'>lorem</a>
               <a href='#'>magazine</a>
               <a href='#'>mask</a>
               <a href='#'>photo</a>
               <a href='#'>Photography</a>
               <a href='#'>plants</a>
               <a href='#'>quick</a>
               <a href='#'>sport</a>
               <a href='#'>Street Aesthetic</a>
               <a href='#'>theme</a>
               <a href='#'>travel</a>
               <a href='#'>Web Design</a>
               <a href='#'>wild life</a>
               <a href='#'>wordpress</a>
            </div>
         </div>
-->

         <?php
            if($pagina != home) { ?>
         <div class="widget">
         <hr class="vertical-space4">
            <h4 class="subtitle">Destacados</h4>
            <div class="postslider">
               <div class="flexslider">
                  <ul class="slides">
                  <?php
                  $cSql = "SELECT * FROM SliderHome WHERE SliVisible='Si' ORDER BY SliOrden ASC LIMIT 0,3";
                  $aResultado = mysql_query($cSql) or die($error_consulta);
                  while($aRegistro = mysql_fetch_array($aResultado)){ 
                     $enlace = addhttp($aRegistro["SliLink"]);
                  ?>

                     <li>
                        <a href="<?php echo $enlace ?>" target="_blank">
                           <img src="./Upload/Directos/SliderHome/<?php echo $aRegistro["SliImagen"] ?>" alt="<?php echo $aRegistro["SliAlt"] ?>" class="thumbnail" />
                           <p><?php echo $aRegistro["SliTitulo"] ?></p>
                        </a>
                     </li>

                  <? } ?>
                  </ul>
               </div>
               <div class="clear"></div>
            </div>
         </div> <!-- end widget -->
         <?php } ?>

         <div class="widget">
         <hr class="vertical-space4">
            <h4 class="subtitle">Calendar</h4>
            <div id="calendar_wrap">
               <table id="wp-calendar">
                  <caption>November 2014</caption>
                  <thead>
                     <tr>
                        <th scope="col" title="Monday">M</th>
                        <th scope="col" title="Tuesday">T</th>
                        <th scope="col" title="Wednesday">W</th>
                        <th scope="col" title="Thursday">T</th>
                        <th scope="col" title="Friday">F</th>
                        <th scope="col" title="Saturday">S</th>
                        <th scope="col" title="Sunday">S</th>
                     </tr>
                  </thead>
                  <tfoot>
                     <tr>
                        <td colspan="3" id="prev"><a href="#" title="View posts for May 2014">&laquo; May</a></td>
                        <td class="pad">&nbsp;</td>
                        <td colspan="3" id="next" class="pad">&nbsp;</td>
                     </tr>
                  </tfoot>
                  <tbody>
                     <tr>
                        <td colspan="5" class="pad">&nbsp;</td>
                        <td>1</td>
                        <td>2</td>
                     </tr>
                     <tr>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                     </tr>
                     <tr>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                        <td>15</td>
                        <td>16</td>
                     </tr>
                     <tr>
                        <td>17</td>
                        <td>18</td>
                        <td>19</td>
                        <td>20</td>
                        <td>21</td>
                        <td>22</td>
                        <td>23</td>
                     </tr>
                     <tr>
                        <td>24</td>
                        <td>25</td>
                        <td>26</td>
                        <td>27</td>
                        <td>28</td>
                        <td>29</td>
                        <td id="today">30</td>
                     </tr>
                  </tbody>
               </table>
            </div> <!-- end calendar_wrap -->
         </div> <!-- end widget -->