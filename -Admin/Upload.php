<?
/*
******************************************************************************
* Administrador de Contenidos                                                *
* -=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-= *
*                                                                            *
* (C) 2002, Fabi�n Chesta                                                    *
*                                                                            *
* Comentarios: Programa basado en "File Uploader" de Hermawan Haryanto       *
*                http://hermawan.dmonster.com                                *
*                                                                            *
******************************************************************************
*/
session_start();

// Archivos de Conexi�n y Configuraci�n
include("Conexion.inc.php");
include("Lenguajes/" . $conf["Lenguaje"]);
include("Funciones/Funciones.inc.php");

$_SESSION["gbl".$conf["VariablesSESSION"]."Modulo"] = $_GET["Modulo"];

// Determina los permisos necesarios para las diferentes acciones
$cSql = "SELECT PerAgregar, VerCntLineas FROM sysModulos LEFT JOIN sysModUsu ON sysModulos.ModNombre=sysModUsu.ModNombre WHERE sysModulos.ModNombre='" . $_SESSION["gbl".$conf["VariablesSESSION"]."Modulo"] . "' AND sysModUsu.UsuAlias='" . $_SESSION["gbl".$conf["VariablesSESSION"]."Alias"] . "'";
$nResultado = mysql_query ($cSql) or die("Error en la consulta: <b>" . $cSql . "</b> <br>Tipo de error: <b>" . mysql_error() . "</b>");
$aRegistro  = mysql_fetch_array($nResultado);

$cnfPerAgregar  = $aRegistro["PerAgregar"];

$CntArchivos = $aRegistro["VerCntLineas"];

mysql_free_result ($nResultado);


//echo("##".$cSql."##");

// Control de Accesos y Permisos
if ($_SESSION["gbl".$conf["VariablesSESSION"]."Alias"]=="" or $cnfPerAgregar!='S') {
  header ("Location: Index.php");
}

// Secciones disponibles para subir el Archivo 
if (isset($_GET["Archivos"])) {
  $cUbicacionUp = $conf['DirUpload'] . $_GET["Archivos"] . "/";
	$cArcTitulo   = ($_GET["Archivos"]=="Imagenes"?"Imagen":"Documento");
	$cArcTipo     = $_GET["Archivos"];
} else {
  $cUbicacionUp = $conf['DirUpload'];
	$cArcTitulo   = "Archivo";
	$cArcTipo     = "";
}
$aDirectorios = explode (",", fDirectorios($cUbicacionUp));
//$aDirectorios = sort ($aDirectorios);
?>
<html>
<head>
  <title></title>
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

  <link rel="stylesheet" href="Estilos/hde.css" type="text/css" />

  <script language="JavaScript" type="text/JavaScript">
  <!--
  function fValidar(Formulario) {
    cAlMenosUno = "No";
    <? for ($i=0;$i<$CntArchivos;$i++) { ?>
        if (Formulario.Archivo<?= $i?>.value!="") {
      	  if (!CheckList(Formulario.Directorio<?= $i?>)) {
            alert("Por favor ingrese la Secci�n del archivo Nro <?= ($i+1)?>");
            Formulario.Directorio<?= $i?>.focus();
            return (false);
      		}
      		cAlMenosUno = "Si";
        }
    <? } ?>
    if (cAlMenosUno=="No") {
      alert("Por favor ingrese al menos un Archivo");
      Formulario.Archivo0.focus();
      return (false);
    }

    return (true);
  }

  // Controla que haya sido seleccionado algun elemento de una lista desplegable
  function CheckList(objLista) {
    for(var n=1; n<objLista.length; n++) {
      if(objLista.options[n].selected) {
        return true;
      }
    }
    return false;
  }
  //-->
  </script>

</head>

<body bgcolor="#FFFFFF" text="#000000" leftmargin="0" topmargin="10" marginwidth="0" marginheight="0">

<span class="gralNormal"><center><b>Subir <?= $cArcTipo?></b></center></span>

  <?
  if ($_POST) {
	  $j=0 ;
    for ($i=0;$i<$CntArchivos;$i++) {
      $DirArchivos = $cUbicacionUp . $_POST["Directorio" . $i];
			// Controla los permisos del directorio
			if (substr(decoct(fileperms($DirArchivos)),-3)!="777") {
        chmod( $DirArchivos, 0777 );  // Octal
			} 
      if (trim($_FILES['Archivo' . $i]['name'])!="") {
        $cNuevoArch = $DirArchivos . "/" . $_FILES['Archivo' . $i]['name'];
        move_uploaded_file($_FILES['Archivo' . $i]['tmp_name'], $cNuevoArch);
        chmod( $cNuevoArch, 0755 );  // Octal
        $j++;

        $aCampos[ 0]["Campo"] = "ArcCodigo" ;       $aCampos[ 0]["Valor"] = 0 ;
        $aCampos[ 1]["Campo"] = "ArcNombre";        $aCampos[ 1]["Valor"] = $_FILES['Archivo' . $i]['name'] ;
        $aCampos[ 2]["Campo"] = "ArcTexto";         $aCampos[ 2]["Valor"] = fPonerBarras($_POST["Texto" . $i]) ;
        $aCampos[ 3]["Campo"] = "ArcDirectorio" ;   $aCampos[ 3]["Valor"] = $_POST["Directorio" . $i] ;
        $aCampos[ 4]["Campo"] = "ArcTipo" ;         $aCampos[ 4]["Valor"] = $cArcTipo ;

        $cSql = fModiData("Archivos", "Agregar", $aCampos) ;

        $nResultado = mysql_query ($cSql) or die("Error en la consulta: " . $cSql . " Tipo de error: " . mysql_error()) ;
      }
    }
  } ?>
  <form onsubmit="return fValidar(this)" method="post" enctype="multipart/form-data">
  <? if (isset($j) and $j==1) { ?>
      <span class="gralNormal"><b><center>El archivo fue subido.</center></b></span>
  <? } elseif (isset($j) and $j>0) { ?>
      <span class="gralNormal"><b><center>Los <?= $j?> archivos fueron subidos.</center></b></span>
  <? } ?>
  <table border="1" cellspacing="0" cellpadding="1" align="center" bordercolor="#FFFFFF" class="gralTabla">
    <tr bgcolor="#929292" align="center" height="20">
      <td><b>&nbsp;Nro.&nbsp;</b></td>
      <td align="center"><b><?= $cArcTitulo?></b></td>
      <td align="center"><b>Descripci�n</b></td>
      <td align="center"><b>Secci�n</b></td>
    </tr>
    <? for($i=0;$i<$CntArchivos;$i++) { ?>
        <tr bgcolor="#D3D3D3">
          <td align="center"><?= ($i+1) ?>.</td>
          <td>&nbsp;<input type="file" name="Archivo<?= $i?>" size="30">&nbsp;</td>
          <td>&nbsp;<input type="text" name="Texto<?= $i?>" size="40" maxlength="100" value="">&nbsp;</td>
          <td>&nbsp;
            <select name="Directorio<?= $i?>" size="1">
              <option value="" selected></option>
              <?
              for ($j=0; $j<count($aDirectorios); $j++) {
                echo("<option value=\"" . $aDirectorios[$j] . "\">" . $aDirectorios[$j] . "</option> \n") ;
              }
              ?>
            </select>
          &nbsp;</td>
        </tr>
    <? } ?>
  </table>
  <br><center><input type="submit" name="action" value="Upload"></center>
  </form>

</body>
</html>