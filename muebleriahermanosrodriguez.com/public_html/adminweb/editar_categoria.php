<?php require_once('../connections/conexion.php'); ?>
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
  $updateSQL = sprintf("UPDATE categoria SET nombre=%s WHERE id_categoria=%s",
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['id_categoria'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "administrador.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$varCategoriaEdi_Categoria_Editar = "0";
if (isset($_GET["recordID"])) {
  $varCategoriaEdi_Categoria_Editar = $_GET["recordID"];
}
mysql_select_db($database_conexion, $conexion);
$query_Categoria_Editar = sprintf("SELECT * FROM categoria WHERE categoria.id_categoria = %s", GetSQLValueString($varCategoriaEdi_Categoria_Editar, "int"));
$Categoria_Editar = mysql_query($query_Categoria_Editar, $conexion) or die(mysql_error());
$row_Categoria_Editar = mysql_fetch_assoc($Categoria_Editar);
$totalRows_Categoria_Editar = mysql_num_rows($Categoria_Editar);
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
<div id="contenido_inter_texto" class="Titulo_negro">Editar Categoria</div>
<div id="contenido_inter_anterior" align="right"><a href="javascript:history.back()" class="Texto"><em>&lt;&lt; Regresar </em></a></div>
</div>

<div id="contenido_inter_datos"><br/ ><br/ >
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="700" align="center">
      <tr valign="baseline">
        <td width="157" nowrap="nowrap" class="Texto">Nombre de la categoria:</td>
        <td width="531"><input name="nombre" type="text" class="casillas" value="<?php echo htmlentities($row_Categoria_Editar['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Editar Categoria" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id_categoria" value="<?php echo $row_Categoria_Editar['id_categoria']; ?>" />
  </form>
  <p>&nbsp;</p>
</div>

</div>
</div>

<div id="pie"><?php include('plantilla/pie.php'); ?></div>

</body>
</html>
<?php
mysql_free_result($Categoria_Editar);
?>
