<?php require_once('Connections/conexion.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE datos SET direccion=%s, calles=%s, cuidad=%s, telefono=%s, celular=%s, correo=%s, mapa=%s WHERE id_datos=%s",
                       GetSQLValueString($_POST['direccion'], "text"),
                       GetSQLValueString($_POST['calles'], "text"),
                       GetSQLValueString($_POST['cuidad'], "text"),
                       GetSQLValueString($_POST['telefono'], "text"),
                       GetSQLValueString($_POST['celular'], "text"),
                       GetSQLValueString($_POST['correo'], "text"),
                       GetSQLValueString($_POST['mapa'], "text"),
                       GetSQLValueString($_POST['id_datos'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "datos.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_Datos = "SELECT * FROM datos";
$Datos = mysql_query($query_Datos, $conexion) or die(mysql_error());
$row_Datos = mysql_fetch_assoc($Datos);
$totalRows_Datos = mysql_num_rows($Datos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de control</title>
<link rel="shortcut icon" href="../favicon.ico">
<link href="plantilla/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #FFF;
}
</style>
</head>

<body>

<div id="principal">

<div id="cabezera">
<?php include('plantilla/cabezera.php'); ?>
</div>

<div id="menu">
<?php include('plantilla/menu.php'); ?>
</div>

<div id="contenido">

<div id="contenido_inter_titulo">
<div id="contenido_inter_texto" class="Titulo_negro">Editar datos de la empresa</div>
</div>

<div id="contenido_inter_datos">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="700" align="center">
      <tr valign="baseline">
        <td width="142" nowrap="nowrap" class="Texto">Direccion:</td>
        <td width="546"><input name="direccion" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['direccion'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" class="Texto">Entre que Calles:</td>
        <td><input name="calles" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['calles'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" class="Texto">Cuidad y estado :</td>
        <td><input name="cuidad" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['cuidad'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" class="Texto">Telefono:</td>
        <td><input name="telefono" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['telefono'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" class="Texto">Celular:</td>
        <td><input name="celular" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['celular'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" class="Texto">Correo:</td>
        <td><input name="correo" type="text" class="casillas" value="<?php echo htmlentities($row_Datos['correo'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td valign="top" nowrap="nowrap" class="Texto">Mapa:</td>
        <td><textarea name="mapa" cols="50" rows="5" class="casillas"><?php echo htmlentities($row_Datos['mapa'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Actualizar Datos de la emrpesa" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id_datos" value="<?php echo $row_Datos['id_datos']; ?>" />
  </form>
  <p>&nbsp;</p>
</div>

</div>
</div>

<div id="pie"><?php include('plantilla/pie.php'); ?></div>

</body>
</html>
<?php
mysql_free_result($Datos);
?>
