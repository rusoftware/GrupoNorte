<?
/* Sitemap version 2.0 (C) copyright Metalhead 2003
 * Página web: http://www.metalhead.ws/phpbin/
 * Este script se distribuye bajo los términos de la
 * Licencia Pública General GNU (GNU GPL)
 * Una copia de la GPL ha sido incluída con el script. */
/* Sección de Configuración */
$showsize = 1; /* Mostrar el tamaño de los archivos? 1 = sí, 0 = no */
/* Array de tipos de archivos visualizados y sus respectivos iconos.
 * Sintaxis: $display[filetype] = "picture"; */
$display[php] = "php.gif";
$display[html] = "html.gif";
$display[htm] = "html.gif";
$display[shtml] = "html.gif";
/* Array de directorios que no deben ser visualizados.
 * Sintaxis: $excludedir[] = "directory"; */
$excludedir[] = "temp";
$excludedir[] = "tmp";
$excludedir[] = "Admin";
$excludedir[] = "cgi-bin";
$excludedir[] = "css";
$excludedir[] = "flash";
$excludedir[] = "imagenes";
$excludedir[] = "isma";
$excludedir[] = "Mail";
$excludedir[] = "js";
$excludedir[] = "oc";
$excludedir[] = "software_to_work";
$excludedir[] = "Upload";

/* Array de archivos que no serán visualizados. */
$excludefile[] = "index.php";
?>
<html><head><title>Mapa del sitio web</title></head>
<body>
<b>Mapa del sitio web</b><p>
<?
$stime = gettimeofday();
/* prueba inicial... */
$root = getcwd();
$pre = explode("/", $REQUEST_URI);
array_pop($pre);
$prefix = join("/", $pre);
/* Si el script se encuentra en un subdirectorio, descomenta las
 * siguientes dos lineas para generar el árbol de todos los
 * archivos y directorios del servidor web */
$root = str_replace($prefix, "", $root);
$prefix = "";
$root .= "/";
/* Visualiza el nombre del servidor y el directorio */
echo "<table cellspacing=0 cellpadding=0 border=0>\n";
echo "<tr><td><img align=absmiddle src=server.gif> http://$SERVER_NAME";
echo "$prefix/";
echo "</td></tr><tr><td><img align=absmiddle src=vertical.gif></td></tr>\n";
function get_extension($name)
{
   $array = explode(".", $name);
   $retval = strtolower(array_pop($array));
   return $retval;
}
/* Rekurencja... */
function list_dir($chdir)
{
   /* algunas variables globales y un poco de orden */
   global $root, $prefix, $PHP_SELF, $SERVER_NAME, $showsize, $display, $excludedir, $excludefile;
   unset($sdirs);
   unset($sfiles);
   chdir($chdir);
   $self = basename($PHP_SELF);
  /* abrimos el directorio actual */
  $handle = opendir('.');
  /* leemos el directorio. Si el objeto
  * es un directorio lo introducimos a
  * $sdirs, si se trata de un archivo
  * que nos interesa (exceptuando el
  * que contiene este script), lo colocamos
  * en $sfiles */
  while ($file = readdir($handle))
  {
    if(is_dir($file) && $file !=
       "." && $file != ".."
       && !in_array($file,
         $excludedir))
    { $sdirs[] = $file; }
    elseif(is_file($file)
      && $file != "$self"
      && array_key_exists(
        get_extension($file),
          $display)
      && !in_array($file,
        $excludefile))
    { $sfiles[] = $file; }
  }
   /* contamos las barras para saber la profundidad a la que estamos
    * o en la estructura de directorios y cuántos segmentos debemos
    * usar de la rama en la que estamos */
   $dir = getcwd();
   $dir1 = str_replace($root, "", $dir."/");
   $count = substr_count($dir1, "/") + substr_count($dir1, "\\");
   /* mostramos por pantalla los nombres y obtenemos la lista recursiva de los
    * directorios */
   if(is_array($sdirs)) {
      sort($sdirs);
      reset($sdirs);
      for($y=0; $y<sizeof($sdirs); $y++) {
         echo "<tr><td>";
         for($z=1; $z<=$count; $z++)
         { echo "<img align=absmiddle src=vertical.gif>&nbsp;&nbsp;&nbsp;"; }
         if(is_array($sfiles))
         { echo "<img align=absmiddle src=verhor.gif>"; }
         else
         { echo "<img align=absmiddle src=verhor1.gif>"; }
         echo "<img align=absmiddle src=folder.gif>
               <a href=\"http://$SERVER_NAME$prefix/$dir1$sdirs[$y]\">$sdirs[$y]</a>";
         list_dir($dir."/".$sdirs[$y]);
      }
   }
   chdir($chdir);
   /* visitamos cada uno de los elementos del array de archivos
    * y los imprimimos */
   if(is_array($sfiles)) {
      sort($sfiles);
      reset($sfiles);
      $sizeof = sizeof($sfiles);
      /* ¿qué tipos de ficheros deben ser visualizados? */
      for($y=0; $y<$sizeof; $y++) {

         echo "<tr><td>";
         for($z=1; $z<=$count; $z++)
         { echo "<img align=absmiddle src=vertical.gif>&nbsp;&nbsp;&nbsp;"; }
         if($y == ($sizeof -1))
         { echo "<img align=absmiddle src=verhor1.gif>"; }
         else
         { echo "<img align=absmiddle src=verhor.gif>"; }
         echo "<img align=absmiddle src=\"";
         echo $display[get_extension($sfiles[$y])];
         echo "\"> ";
         echo "<a href=\"http://$SERVER_NAME$prefix/$dir1$sfiles[$y]\">$sfiles[$y]</a>";
         if($showsize) {
            $fsize = @filesize($sfiles[$y])/1024;
            printf(" (%.2f kB)", $fsize);
         }
         echo "</td></tr>";
         echo "<tr><td>";
      }
      echo "<tr><td>";
      for($z=1; $z<=$count; $z++)
      { echo "<img align=absmiddle src=vertical.gif>&nbsp;&nbsp;&nbsp;"; }
      echo "</td></tr>\n";
   }
}
list_dir($root);
echo "</table>\n";
/* ¿Cuánto tiempo nos llevó? */
$ftime = gettimeofday();
$time = round(($ftime[sec] + $ftime[usec] / 1000000) - ($stime[sec] + $stime[usec] / 1000000), 5);
echo "<center>Tiempo de generación de la página: $time segundos</center>\n";
?>
</body></html>