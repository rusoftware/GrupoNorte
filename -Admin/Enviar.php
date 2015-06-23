<?
/*
******************************************************************************
* Administrador de Contenidos                                                *
* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= *
*                                                                            *
* (C) 2005, Fabián Chesta                                                    *
*                                                                            *
* Comentarios:                                                               *
*                                                                            *
******************************************************************************
*/
session_start();

set_time_limit (3600);

// Archivos de Conexión y Configuración
include("Conexion.inc.php");
include("Lenguajes/" . $conf["Lenguaje"]);
include("Funciones/Funciones.inc.php");

// Determina los permisos necesarios para las diferentes acciones
$cSql = "SELECT ModTexto, PerAcciones FROM sysModulos LEFT JOIN sysModUsu ON sysModulos.ModNombre=sysModUsu.ModNombre WHERE sysModulos.ModNombre='" . $_SESSION["gblModulo"] . "' AND sysModUsu.UsuAlias='" . $_SESSION["gblAlias"] . "'";
$nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
$aRegistro  = mysql_fetch_array($nResultado);

$cnfPerAcciones = $aRegistro["PerAcciones"];

mysql_free_result ($nResultado);


// Control de Accesos y Permisos
// if ($_SESSION["gblAlias"]=="" or $cnfPerAcciones!='S') {
//  echo ("No tiene autorización para ejecutar este programa.");
//  exit ;
// }


// Determina cual es el Newsletter que el usuario desea enviar
$cSql = "SELECT NwsEdicTitulo, NwsEdicSaludoHTML, NwsEdicSaludoText, UsrActivo, UsrCliente, UsrCaptacion, UsrProvee, UsrComercio, UsrCosme, UsrAsoc, UsrPublico, UsrIndustria, UsrProfesional, UsrPublicidad, UsrFood, NwsEdicEnvio FROM NwsEdicion WHERE NwsEdicCodigo=" . $_REQUEST["Codigo"] ;
$nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
$aRegistro  = mysql_fetch_array($nResultado);

/*                                // Control de envío completo
                                  if ($aRegistro["NwsEdicEnvio"]=="Totalmente") {
                                    echo ("Este Newsletter ya fue enviado totalmente.");
                                    exit ;
                                  }                                                   */
$cEstadoEnvi = $aRegistro["NwsEdicEnvio"] ;

$cAsunto     = $aRegistro["NwsEdicTitulo"] ;           // Asunto del mail
$cDesdeMail  = $conf["DireccionMailPredeterminada"] ;  // Dirección desde la cual se envía
$cRetorMail  = $conf["DireccionMailRetorno"] ;         // Dirección de retorno
$nCuantos    = $conf["CantidadMailsPorEnvio"] ;        // Cantidad de registros que toma para cada envío

$cSaludo     = $aRegistro["NwsEdicSaludoHTML"] ;           // Texto inicial
$cContDinHTML  = $aRegistro["NwsEdicContHTML"] ;         // Contenido HTML del mail
$cContDinTexto = $aRegistro["NwsEdicContTexto"] ;        // Contenido Texto del mail

$cFiltroSus  = "1=2" ;                                 // Para prevenir que no haya seleccionado ningun 'Si'
$cFiltroSus .= ($aRegistro["UsrActivo"]=="Si"?" OR UsrActivo='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrCliente"]=="Si"?" OR UsrCliente='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrCaptacion"]=="Si"?" OR UsrCaptacion='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrProvee"]=="Si"?" OR UsrProvee='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrComercio"]=="Si"?" OR UsrComercio='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrCosme"]=="Si"?" OR UsrCosme='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrAsoc"]=="Si"?" OR UsrAsoc='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrPublico"]=="Si"?" OR UsrPublico='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrIndustria"]=="Si"?" OR UsrIndustria='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrProfesional"]=="Si"?" OR UsrProfesional='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrPublicidad"]=="Si"?" OR UsrPublicidad='Si'":"") ;
$cFiltroSus .= ($aRegistro["UsrFood"]=="Si"?" OR UsrFood='Si'":"") ;
$cFiltroSus  = "(" . $cFiltroSus . ")" ;

mysql_free_result ($nResultado);


// Determina Fecha y Hora del último envío
$cSql = "SELECT COUNT(*) AS ccCntEnvios, DATE_FORMAT(MAX(NwsEnviFecha),'%d-%m-%Y %H:%i:%s') AS ccUltEnvio FROM NwsEnvio WHERE NwsEdicCodigo=" . $_REQUEST["Codigo"] ;
$nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
$aRegistro  = mysql_fetch_array($nResultado);

$nCntEnvios   = $aRegistro["ccCntEnvios"] ;            // Cantidad de mails enviados
$dFechaUltEnv = $aRegistro["ccUltEnvio"] ;             // Texto inicial

mysql_free_result ($nResultado);


// Si aún no ha sido enviado totalmente, determina la
// cantidad de suscriptores que falta recibir el mail
if ($cEstadoEnvi=='Totalmente') {
  $nCntTotal  = $nCntEnvios ;                          // Cantidad de mails enviados

} else {
  $cSql = "SELECT "
        . "  COUNT(UsrCode) AS ccCntTotal "
        . "FROM Users "
        . "WHERE UsrActivo='Si' AND " . $cFiltroSus ;
  $nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
  $aRegistro  = mysql_fetch_array($nResultado);

  $nCntTotal  = $aRegistro["ccCntTotal"] ;             // Cantidad de mails enviados

  mysql_free_result ($nResultado);
}


// Arma el contenido del mail
$cContHTML   = "<table width=\"500\" border=\"0\" cellspacing=\"5\" cellpadding=\"0\">" ;
//$cContTexto  = "" ;

$cContHTML  .= "  <tr> \n";
$cContHTML  .= "    <td> \n";
$cContHTML  .= "      <font color=\"#23221e\">" . $cContDinHTML . "</font>";
$cContHTML  .= "    </td> \n";
$cContHTML  .= "  </tr> \n";
//$cContHTML  .= "  <tr> \n";
//$cContHTML  .= "    <td>&nbsp;</td> \n";
//$cContHTML  .= "  </tr> \n";

//$cContTexto  = $cContDinTexto . " \n\n";

// Saludo inicial del Newsletter
if ($cSaludo!="") {
  $cContHTML  .= "  <tr> \n";
  $cContHTML  .= "    <td> \n";
  $cContHTML  .= "      <p><font color=\"#23221e\" size=\"2\">" . nl2br($cSaludo) . "</font></p> \n";
  $cContHTML  .= "    </td> \n";
  $cContHTML  .= "  </tr> \n";
//  $cContHTML  .= "  <tr> \n";
//  $cContHTML  .= "    <td>&nbsp;</td> \n";
//  $cContHTML  .= "  </tr> \n";

//  $cContTexto  = $cSaludo . " \n\n";
}


// Novedades a incluir en el Newsletter
$cSql = "SELECT "
      . "  NwsContenido.NovCodigo, NovTitulo, NovApost "
      . "FROM NwsContenido "
      . "  INNER JOIN Novedades ON NwsContenido.NovCodigo=Novedades.NovCodigo "
      . "WHERE NwsContenido.NwsEdicCodigo=" . $_REQUEST["Codigo"] . " "
      . "ORDER BY NovCodigo DESC" ;
$nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");

while ( $aRegistro=mysql_fetch_array($nResultado) ) {

  if ($aRegistro["ccImagen"] && is_file("../Upload/" . $aRegistro["ccImagen"])) {
    $aPropImg = getimagesize ("../Upload/" . $aRegistro["ccImagen"]);
    $cImagen = "<img src=\"Upload/" . $aRegistro["ccImagen"] . "\" " . $aPropImg[3] . " align=\"right\">" ;
  } else {
    $cImagen = "" ;
  }

  $cContHTML  .= "  <tr> \n";
  $cContHTML  .= "    <td> \n";
  $cContHTML  .= "      <p><a href=\"http://www.borsellinoimpresos.com/Novedades.php?Nota=" . $aRegistro["NovCodigo"] . "\"><strong><font color=\"#23221e\" size=\"2\">" . $aRegistro["NovTitulo"] . "</font></strong></a></p> \n";
  $cContHTML  .= "      <p><font color=\"#23221e\" size=\"2\">" . $cImagen . nl2br($aRegistro["NovApost"]) . "</font>";
  $cContHTML  .= " <br>";
  $cContHTML  .= " <a href=\"http://www.borsellinoimpresos.com/Novedades.php?Nota=" . $aRegistro["NovCodigo"] . "\"><strong><font color=\"#23221e\" size=\"1\">  ver nota ></font></strong></a></p> \n";
  $cContHTML  .= "    </td> \n";
  $cContHTML  .= "  </tr> \n";
  $cContHTML  .= "  <tr> \n";
  $cContHTML  .= "    <td>&nbsp;</td> \n";
  $cContHTML  .= "  </tr> \n";

  $cContTexto .= $aRegistro["NovTitulo"] . " \n";
  $cContTexto .= $aRegistro["NovApost"] . " \n\n";
}
mysql_free_result ($nResultado);


$cContHTML .= "</table>" ;

?>

<html>
<head>
  <title>Envío de Newsletter</title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

  <link rel="stylesheet" href="Estilos/hde.css" type="text/css">

  <script language="JavaScript">
    function changeCaption(ele,txt) {
      if (document.getElementById) {
        document.getElementById(ele).firstChild.data = txt;
      } else if (document.all) {
        document.all[ele].firstChild.data = txt;
      }
    }
  </script> 
</head>

<body onUnload="javascript:top.Principal.Cuerpo.location.reload();" bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0">
<table width="95%" border="1" cellspacing="0" cellpadding="1" align="center" bordercolor="#FFFFFF" class="gralTabla">
  <tr>
    <td colspan="4" align="center" bgcolor="#DC9137">
      <span class="gralNormal"><b>Env&iacute;o de Newsletter</b></span>
    </td>
  </tr>
  <tr height="25">
    <td bgcolor="#929292" width="25%" align="right">
      <b>T&iacute;tulo:</b>&nbsp;
    </td>
    <td colspan="3" bgcolor="#D3D3D3" width="75%" align="left">
      &nbsp;<?= $cAsunto?>
    </td>
  </tr>
  <tr height="25">
    <td bgcolor="#929292" width="25%" align="right">
      <b>Enviado:</b>&nbsp;
    </td>
    <td colspan="3" bgcolor="#D3D3D3" width="75%" align="left">
      &nbsp;<?= $cEstadoEnvi . " ( " . $nCntEnvios . " de " . $nCntTotal . " )"?>
    </td>
  </tr>
  <tr height="25">
    <td bgcolor="#929292" width="25%" align="right">
      <b>Ultimo Env&iacute;o:</b>&nbsp;
    </td>
    <td colspan="3" bgcolor="#D3D3D3" width="75%" align="left">
      &nbsp;<?= $dFechaUltEnv?>
    </td>
  </tr>
  <tr height="25">
    <td bgcolor="#929292" width="25%" align="right">
      <b>Desde eMail:</b>&nbsp;
    </td>
    <td colspan="3" bgcolor="#D3D3D3" width="75%" align="left">
      &nbsp;<?= htmlentities($cDesdeMail)?>
    </td>
  </tr>
  <tr height="25">
    <td bgcolor="#929292" width="25%" align="right">
      <b>Env&iacute;os consecutivos:</b>&nbsp;
    </td>
    <td colspan="3" bgcolor="#D3D3D3" width="75%" align="left">
      &nbsp;<?= $nCuantos?>
    </td>
  </tr>
  <tr height="25" bgcolor="#DC9137">
    <? if ($_GET['Desde']=='EnvPrueba') { ?>
      <td colspan="4">
        &nbsp;<span id="EstadoEnvio">Enviando Prueba</span>
      </td>
    <? } elseif ($_GET['Desde']=='EnvNews') { ?>
      <td colspan="4">
        &nbsp;<span id="EstadoEnvio">Enviando Newsletter</span>
      </td>
    <? } elseif ($cEstadoEnvi=='Totalmente') { ?>
      <td colspan="4" align="center">
        <input class="blanco" type="submit" name="EnvTotal" value="Newsletter Totalmente Enviado" onClick="javascript:parent.window.close()">&nbsp;
      </td>
    <? } else { ?>
      <td colspan="4" align="center">
        <input class="blanco" type="submit" name="EnvPrueba" value="Enviar Pruebas" onClick="javascript:location.href='Enviar.php?Desde=EnvPrueba&Codigo=<?= $_REQUEST["Codigo"]?>'">&nbsp;
        <input class="blanco" type="submit" name="EnvNewsletter" value="Enviar Newsletter" onClick="javascript:location.href='Enviar.php?Desde=EnvNews&Codigo=<?= $_REQUEST["Codigo"]?>'">
      </td>
    <? } ?>
  </tr>
</table>


<? 
if ($_GET['Desde']=='EnvPrueba' || $_GET['Desde']=='EnvNews') {

  include('./htmlMimeMail/htmlMimeMail.php');

  if ($_GET['Desde']=='EnvPrueba') {
    $cFiltro = "UsrPrueba='Si'" ;
    $cEstado = "Enviando Prueba" ;

  } else {
    $cFiltro = "UsrActivo='Si' AND " . $cFiltroSus . " AND UsrCode NOT IN (SELECT UsrCode FROM NwsEnvio WHERE NwsEdicCodigo=" . $_REQUEST["Codigo"] . ")";
    $cEstado = "Enviando Newsletter" ;
  }

  $cSql = "SELECT "
        . "  UsrCode, UsrFirstName1, UsrEMail1, UsrPassword "
        . "FROM Users "
        . "WHERE " . $cFiltro . " "
        . "LIMIT " . $nCuantos ;
  $nResultado = mysql_query ($cSql) or die("Error en la consulta: " . $cSql . " Tipo de error: " . mysql_error());

  $nFilasTot = mysql_num_rows($nResultado) ;
  $nFilasAct = 0 ;

  while ($aRegistro = mysql_fetch_array($nResultado)) {
    $nFilasAct++ ;

    $oMail = new htmlMimeMail();
    $oMail->setHeader('X-Mailer', 'HTML Mime mail');
    $oMail->setHeader('MIME-Version', '1.0');
//  $oMail->setHeader('Content-type', 'text/html;charset=ISO-8859-9');
  $oMail->setTextCharset("utf-8");
  $oMail->setHTMLCharset("utf-8");
  $oMail->setHeadCharset("utf-8");

    $cTexto = $oMail->getFile("./Newsletter/Newsletter.txt");
    $cTexto = str_replace("##Contenido##", $cContTexto, $cTexto);
    $cTexto = str_replace("##Nombre##", ucwords(strtolower($aRegistro['UsrFirstName1'])), $cTexto);
    $cTexto = str_replace("##EMail##", $aRegistro["UsrEMail1"], $cTexto);
    $cTexto = str_replace("##Clave##", $aRegistro["UsrPassword"], $cTexto);
    $cTexto = str_replace("##ClaveBaja##", md5("#".$aRegistro["UsrCode"]."#".$aRegistro["UsrEMail1"]."#"), $cTexto);

    $cHTML  = $oMail->getFile("./Newsletter/Newsletter.html");
    $cHTML  = str_replace("##Contenido##", $cContHTML, $cHTML);
    $cHTML  = str_replace("##Nombre##", ucwords(strtolower($aRegistro['UsrFirstName1'])), $cHTML);
    $cHTML  = str_replace("##EMail##", $aRegistro["UsrEMail1"], $cHTML);
    $cHTML  = str_replace("##Clave##", $aRegistro["UsrPassword"], $cHTML);		
    $cHTML  = str_replace("##ClaveBaja##", md5("#".$aRegistro["UsrCode"]."#".$aRegistro["UsrEMail1"]."#"), $cHTML);

    $oMail->setHtml($cHTML, $cTexto, '../');
    $oMail->setFrom($cDesdeMail);
    $oMail->setReturnPath($cRetorMail);
    $oMail->setSubject($cAsunto);
    $oMail->send(array($aRegistro["UsrEMail1"]));

    unset($oMail);

    if ($_GET['Desde']=='EnvNews') {
      $cSql = "INSERT INTO NwsEnvio (NwsEdicCodigo, UsrCode) VALUES (" . $_REQUEST["Codigo"] . ", " . $aRegistro["UsrCode"] . ")";
      $nResulIns = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
    }

    ?>
    <script language="JavaScript">
      changeCaption('EstadoEnvio', '<?= $cEstado?> - <?= str_replace("'","\'",$aRegistro["UsrFirstName1"])?> [<?= $aRegistro["UsrEMail1"]?>] - <?= $nFilasAct?> de <?= $nFilasTot?>');
    </script>
    <?
  }
  mysql_free_result ($nResultado);

  if ($_GET['Desde']=='EnvNews') {
    $cSql = "SELECT "
          . "  COUNT(UsrCode) AS ccCntRegistros "
          . "FROM Users "
          . "WHERE UsrActivo='Si' AND " . $cFiltroSus . " AND UsrCode NOT IN (SELECT UsrCode FROM NwsEnvio WHERE NwsEdicCodigo=" . $_REQUEST["Codigo"] . ")";
    $nResultado = mysql_query ($cSql) or die("Error en la consulta: " . $cSql . " Tipo de error: " . mysql_error());

    $aRegistro = mysql_fetch_array($nResultado) ;

    $nCntFaltan = $aRegistro["ccCntRegistros"];

    mysql_free_result ($nResultado);

    $cSql = "UPDATE NwsEdicion SET NwsEdicEnvio='" . ($nCntFaltan==0?"Totalmente":"Parcialmente") . "' WHERE NwsEdicCodigo=" . $_REQUEST["Codigo"] ;
    $nResulIns = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");

    ?>
    <script language="JavaScript">
      // ERROR JS -> Actualizar la pagina principal
      // opener.location.reload();
      opener.Cuerpo.location.reload();
      // document.top.Principal.Cuerpo.location.reload();
      // document.getElementById('Principal').location.reload();
      // Info.location.reload();
    </script><?
  } 
} ?>

</body>
</html>
