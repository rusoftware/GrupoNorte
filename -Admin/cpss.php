<?
session_start();

// Archivos de Conexión y Configuración
include("Conexion.inc.php");
include("Lenguajes/" . $conf["Lenguaje"]);
include("Funciones/Funciones.inc.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Documento sin título</title>
<style type="text/css">
body{
	background-color: #fbfbfb;
	font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
	font-size: 14px;
	line-height: 1em;
}
.head{
	background-color: #ebebeb;
	text-align: center;
	padding: 8px;
	border-bottom: solid 1px #ffffff;
}
h1{
	font-size: 1.8em;
	line-height: 1.1em;
	margin: 0; padding: 0;
}
h2{
	font-size: 1.4em;
	line-height: 1.1em;
	margin: 0; padding: 0;
}
h3{
	font-size: 1.2em;
	line-height: 1.1em;
	margin: 0; padding: 0;
}
.boton{
	padding:8px;
	text-align:center;
	font-weight: bold;
	color: #666666;
	background-color: transparent;
}
.boton.active{
	background-color: #ebebeb;
}
#btnDungeon, #btnTW, #btnQueen, #btnOtros{
	cursor: pointer;
}
#tablaDungeon, #tablaTW, #tablaQueen, #tablaOtros{
	display: none;
}
#btnDungeon{ border-bottom: solid 2px #FFCC33;}
#btnTW{	border-bottom: solid 2px #66CC00;}
#btnQueen{	border-bottom: solid 2px #0099FF;}
#btnOtros{	border-bottom: solid 2px #FF6699;}
#tablaDungeon{ display: block; }
.bgTitDungeon{ background-color: #FFCC33;}
.bgTitTW{ background-color: #66CC00;}
.bgTitQueen{ background-color: #0099FF;}
.bgTitOtros{ background-color: #FF6699;}

#tablaDungeon tr:nth-child(odd), #tablaTW tr:nth-child(odd), #tablaQueen tr:nth-child(odd), #tablaOtros tr:nth-child(odd){
	background: #FCF;
	border-bottom: solid 1px #ebebeb;
}
#tablaDungeon tr:nth-child(even), #tablaTW tr:nth-child(even), #tablaQueen tr:nth-child(even), #tablaOtros tr:nth-child(even){
	background: #FCC;
	border-bottom: solid 1px #ebebeb;
}
#tablaDungeon tr td, #tablaTW tr td, #tablaQueen tr td, #tablaOtros tr td{
	padding: 4px;
	border-right: solid 1px #FFF;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
	/* tabs */
	$("#btnDungeon").click(function(){
		$("#tablaTW").css("display", "none");
		$("#tablaQueen").css("display", "none");
		$("#tablaOtros").css("display", "none");
		$("#tablaDungeon").css("display", "block");
		$("#btnDungeon").addClass("active");
		$("#btnTW").removeClass("active");
		$("#btnQueen").removeClass("active");
		$("#btnOtros").removeClass("active");
		$("#TituloFormPass").html("<h2>Cambio de Pass PJS DUNGEON</h2>");
		$("#TablaFormPass").removeAttr("class");
		$("#TablaFormPass").addClass("bgTitDungeon");
	});
	$("#btnTW").click(function(){
		$("#tablaTW").css("display", "block");
		$("#tablaQueen").css("display", "none");
		$("#tablaOtros").css("display", "none");
		$("#tablaDungeon").css("display", "none");
		$("#btnDungeon").removeClass("active");
		$("#btnTW").addClass("active");
		$("#btnQueen").removeClass("active");
		$("#btnOtros").removeClass("active");
		$("#TituloFormPass").html("<h2>Cambio de Pass PJS TW</h2>");
		$("#TablaFormPass").removeAttr("class");
		$("#TablaFormPass").addClass("bgTitTW");
	});
	$("#btnQueen").click(function(){
		$("#tablaTW").css("display", "none");
		$("#tablaQueen").css("display", "block");
		$("#tablaOtros").css("display", "none");
		$("#tablaDungeon").css("display", "none");
		$("#btnDungeon").removeClass("active");
		$("#btnTW").removeClass("active");
		$("#btnQueen").addClass("active");
		$("#btnOtros").removeClass("active");
		$("#TituloFormPass").html("<h2>Cambio de Pass PJS QUEEN</h2>");
		$("#TablaFormPass").removeAttr("class");
		$("#TablaFormPass").addClass("bgTitQueen");
	});
	$("#btnOtros").click(function(){
		$("#tablaTW").css("display", "none");
		$("#tablaQueen").css("display", "none");
		$("#tablaOtros").css("display", "block");
		$("#tablaDungeon").css("display", "none");
		$("#btnDungeon").removeClass("active");
		$("#btnTW").removeClass("active");
		$("#btnQueen").removeClass("active");
		$("#btnOtros").addClass("active");
		$("#TituloFormPass").html("<h2>Cambio de Pass otros PJS</h2>");
		$("#TablaFormPass").removeAttr("class");
		$("#TablaFormPass").addClass("bgTitOtros");
	});
	
	/* cambios pass por pj */
	$(".submito").click(function(event){
		//alert($(this).attr("title"));
		formu = $(this).attr("title");
		vieja = $("#passvieja").val();
		nueva = $("#passnueva").val();
		$("#OLD"+formu).attr('value', vieja);
		$("#NEW1"+formu).attr('value', nueva);
		$("#NEW2"+formu).attr('value', nueva);
		$("#"+formu).submit();
		$(this).attr("disabled", "disabled");
	});
/*	$("#registro1fdolSubmit").click(function(event){
		event.preventDefault();
		vieja = $("#passvieja").val();
		nueva = $("#passnueva").val();
		$("#oldpassFDOL").attr('value', vieja);
		$("#pass1FDOL").attr('value', nueva);
		$("#pass2FDOL").attr('value', nueva);
		//$("#oldpassFDOL").value = $("#passvieja").value;
		//$("#pass1FDOL").value = $("#passnueva").value;
		//$("#pass2FDOL").value = $("#passnueva").value;
		//alert("anda");
		$("#registro1fdol").submit();
		$("#registro1fdolSubmit").attr("disabled", "disabled");
		//alert(msg);
	});*/
	
	/*$("#registro1fdol").submit(function(event){
		event.preventDefault();
		
	});*/
});
</script>
</head>

<body style="margin:0 auto; padding:0; font-family:'Trebuchet MS' ,Arial, Helvetica, sans-serif">
<table width="100%" cellpadding="0" cellspacing="0" border="0">
<tr>
  <td><div class="head"><h1>- Critical Hit -</h1><h3>Password Handler</h3></div></td>
</tr>
<tr>
  <td align="center" bgcolor="#dbdbdb" style="border-bottom: solid 1px #ffffff;">
    <table width="800" cellspacing="0" cellpadding="0" border="0"><tr>
      <td align="center" bgcolor="#FFCC33" width="200"><div class="boton active" id="btnDungeon">DUNGEON</div></td>
      <td align="center" bgcolor="#66CC00" width="200"><div class="boton" id="btnTW">TERRITORY WARD</div></td>
      <td align="center" bgcolor="#0099FF" width="200"><div class="boton" id="btnQueen">QUEEN</div></td>
      <td align="center" bgcolor="#FF6699" width="200"><div class="boton" id="btnOtros">OTROS</div></td>
    </tr></table>
  </td>
</tr>
<tr>
  <td align="center">

	<!-- ALMACENO LAS VARIABLES Q REPETIRE DE PASS VIEJA y NUEVA-->
    <table width="800" cellpadding="4" cellspacing="2" border="0" id="TablaFormPass" class="bgTitDungeon">
      <tr><td colspan="2" align="center" id="TituloFormPass"><h2>Cambio cuentas general del idolo</h2></td></tr>
      <tr>
        <td width="235" align="right"><em><strong>contraseña vieja:</strong></em></td><td width="543"><input type="text" name="passvieja" id="passvieja" value="" style="width: 220px" /></td></tr>
      <tr>
        <td align="right" style="padding-bottom:8px;"><em><strong>contraseña nueva:</strong></em></td><td style="padding-bottom:8px;"><input type="text" name="passnueva" id="passnueva" value="" style="width: 220px" /></td></tr>
    </table>
    <!-- -->

  </td>
</tr><tr>
  <td align="center" style="padding-top:8px;">

	<table width="800" cellpadding="0" cellspacing="0" border="0" id="tablaDungeon" style="border-collapse: collapse">
	  <thead>
	    <tr>
      	<th width="250" bgcolor="#ebebeb" style="padding:6px 0;">PJ</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Nombre Usuario</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Tipo</th>
        <th width="150" bgcolor="#ebebeb" style="padding:6px 0;">PASS</th>
      </tr></thead>
      <tbody>
      <?
	  $cSql = " SELECT PjCodigo, PjNombre, PjClase, PjUser, PjPagina FROM Pejotitas WHERE PjPagina='Dungeon'";
	  $cResultado = mysql_query($cSql) or die(mysql_error());
	  while ($aRegistro = mysql_fetch_array($cResultado)){
	  echo '
	  <tr>
        <td>'.$aRegistro["PjNombre"].'</td>
        <td>'.$aRegistro["PjUser"].'</td>
        <td>'.$aRegistro["PjClase"].'</td>
        <td align="center">
          <form name="registro1'.$aRegistro["PjUser"].'" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1'.$aRegistro["PjUser"].'">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="'.$aRegistro["PjUser"].'">
            <input type="hidden" name="oldpass" id="OLDregistro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1'.$aRegistro["PjUser"].'" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1'.$aRegistro["PjUser"].'Submit" value="CAMBIAR" class="submito" title="registro1'.$aRegistro["PjUser"].'" />
          </form>
          <!--<a href="" id="registro1'.$aRegistro["PjUser"].'Submit">CAMBIAR</a>-->
        </td>
      </tr>
	  ';
	  }
	  ?>
      
      <!--
      <tr>
        <td>DwarfPP</td>
        <td>fdpp</td>
        <td>Enana (p/sub PP)</td>
        <td align="center">
          <form name="registro1fdpp" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1fdpp">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="fdpp">
            <input type="hidden" name="oldpass" id="OLDregistro1fdpp" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1fdpp" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1fdpp" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1fdppSubmit" value="CAMBIAR" class="submito" title="registro1fdpp" />
          </form>
        </td>
      </tr>
      
      <tr>
        <td>DwarfSE</td>
        <td>fdse</td>
        <td>Enana (p/sub SE)</td>
        <td align="center">
          <form name="registro1fdse" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1fdse">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="fdse">
            <input type="hidden" name="oldpass" id="OLDregistro1fdse" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1fdse" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1fdse" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1fdseSubmit" value="CAMBIAR" class="submito" title="registro1fdse" />
          </form>
        </td>
      </tr>
      
      <tr>
        <td>DwarfBD</td>
        <td>fdbd</td>
        <td>Enana (p/sub BD)</td>
        <td align="center">
          <form name="registro1fdbd" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1fdbd">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="fdbd">
            <input type="hidden" name="oldpass" id="OLDregistro1fdbd" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1fdbd" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1fdbd" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1fdbdSubmit" value="CAMBIAR" class="submito" title="registro1fdbd" />
          </form>
        </td>
      </tr>
      
      <tr>
        <td>DwarfEE</td>
        <td>fdee</td>
        <td>Enana (p/sub EE)</td>
        <td align="center">
          <form name="registro1fdee" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1fdee">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="fdee">
            <input type="hidden" name="oldpass" id="OLDregistro1fdee" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1fdee" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1fdee" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1fdeeSubmit" value="CAMBIAR" class="submito" title="registro1fdee" />
          </form>
        </td>
      </tr>
      -->
      </tbody>
    </table>
   	
    
<!-- TABLA TW -->
    <table width="800" cellpadding="0" cellspacing="0" border="0" id="tablaTW" style="border-collapse: collapse">
	  <thead>
	    <tr>
      	<th width="250" bgcolor="#ebebeb" style="padding:6px 0;">PJ</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Nombre Usuario</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Tipo</th>
        <th width="150" bgcolor="#ebebeb" style="padding:6px 0;">PASS</th>
      </tr></thead>
      <tbody>
      <?
	  $cSql = " SELECT PjCodigo, PjNombre, PjClase, PjUser, PjPagina FROM Pejotitas WHERE PjPagina='TW'";
	  $cResultado = mysql_query($cSql) or die();
	  while ($aRegistro = mysql_fetch_array($cResultado)){
	  echo '
	  <tr>
        <td>'.$aRegistro["PjNombre"].'</td>
        <td>'.$aRegistro["PjUser"].'</td>
        <td>'.$aRegistro["PjClase"].'</td>
        <td align="center">
          <form name="registro1'.$aRegistro["PjUser"].'" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1'.$aRegistro["PjUser"].'">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="'.$aRegistro["PjUser"].'">
            <input type="hidden" name="oldpass" id="OLDregistro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1'.$aRegistro["PjUser"].'" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1'.$aRegistro["PjUser"].'Submit" value="CAMBIAR" class="submito" title="registro1'.$aRegistro["PjUser"].'" />
          </form>
          <!--<a href="" id="registro1'.$aRegistro["PjUser"].'Submit">CAMBIAR</a>-->
        </td>
      </tr>
	  ';
	  }
	  ?>
      </tbody>
    </table>



<!-- QUEEN -->
    <table width="800" cellpadding="0" cellspacing="0" border="0" id="tablaQueen" style="border-collapse: collapse">
	  <thead>
	    <tr>
      	<th width="250" bgcolor="#ebebeb" style="padding:6px 0;">PJ</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Nombre Usuario</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Tipo</th>
        <th width="150" bgcolor="#ebebeb" style="padding:6px 0;">PASS</th>
      </tr></thead>
      <tbody>
      <?
	  $cSql = " SELECT PjCodigo, PjNombre, PjClase, PjUser, PjPagina FROM Pejotitas WHERE PjPagina='Queen'";
	  $cResultado = mysql_query($cSql) or die();
	  while ($aRegistro = mysql_fetch_array($cResultado)){
	  echo '
	  <tr>
        <td>'.$aRegistro["PjNombre"].'</td>
        <td>'.$aRegistro["PjUser"].'</td>
        <td>'.$aRegistro["PjClase"].'</td>
        <td align="center">
          <form name="registro1'.$aRegistro["PjUser"].'" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1'.$aRegistro["PjUser"].'">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="'.$aRegistro["PjUser"].'">
            <input type="hidden" name="oldpass" id="OLDregistro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1'.$aRegistro["PjUser"].'" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1'.$aRegistro["PjUser"].'Submit" value="CAMBIAR" class="submito" title="registro1'.$aRegistro["PjUser"].'" />
          </form>
          <!--<a href="" id="registro1'.$aRegistro["PjUser"].'Submit">CAMBIAR</a>-->
        </td>
      </tr>
	  ';
	  }
	  ?>
      </tbody>
    </table>

	<table width="800" cellpadding="0" cellspacing="0" border="0" id="tablaOtros" style="border-collapse: collapse">
      <thead>
	    <tr>
      	<th width="250" bgcolor="#ebebeb" style="padding:6px 0;">PJ</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Nombre Usuario</th>
        <th width="200" bgcolor="#ebebeb" style="padding:6px 0;">Tipo</th>
        <th width="150" bgcolor="#ebebeb" style="padding:6px 0;">PASS</th>
      </tr></thead>
      <tbody>
      <?
	  $cSql = " SELECT PjCodigo, PjNombre, PjClase, PjUser, PjPagina FROM Pejotitas WHERE PjPagina='Otros'";
	  $cResultado = mysql_query($cSql) or die();
	  while ($aRegistro = mysql_fetch_array($cResultado)){
	  echo '
	  <tr>
        <td>'.$aRegistro["PjNombre"].'</td>
        <td>'.$aRegistro["PjUser"].'</td>
        <td>'.$aRegistro["PjClase"].'</td>
        <td align="center">
          <form name="registro1'.$aRegistro["PjUser"].'" method="post" action="http://l2.comunidadzero.com/img_micuenta/misdatos/chpass2.php?name=L2&op=chpass" target="_blank" id="registro1'.$aRegistro["PjUser"].'">
            <input type="hidden" name="form_name" value="chpass">
            <input type="hidden" name="fname" maxlenght="15" width="310" class="pie" value="'.$aRegistro["PjUser"].'">
            <input type="hidden" name="oldpass" id="OLDregistro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass1" id="NEW1registro1'.$aRegistro["PjUser"].'" maxlenght="15" width="310" class="pie" value="">
            <input type="hidden" name="pass2" id="NEW2registro1'.$aRegistro["PjUser"].'" width="310" maxlenght="15" class="pie" value="">
            <input type="button" id="registro1'.$aRegistro["PjUser"].'Submit" value="CAMBIAR" class="submito" title="registro1'.$aRegistro["PjUser"].'" />
          </form>
          <!--<a href="" id="registro1'.$aRegistro["PjUser"].'Submit">CAMBIAR</a>-->
        </td>
      </tr>
	  ';
	  }
	  ?>
      </tbody>
	</table>

</td></tr></table></body>
</html>