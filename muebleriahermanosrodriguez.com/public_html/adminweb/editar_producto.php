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
  $updateSQL = sprintf("UPDATE productos SET foto=%s, nombre=%s, descripcion=%s, categoria=%s, precio=%s WHERE id_producto=%s",
                       GetSQLValueString($_POST['foto'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['categoria'], "int"),
                       GetSQLValueString($_POST['precio'], "text"),
                       GetSQLValueString($_POST['id_producto'], "int"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($updateSQL, $conexion) or die(mysql_error());

  $updateGoTo = "administrador.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_categoria = "SELECT * FROM categoria";
$categoria = mysql_query($query_categoria, $conexion) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);

$varProduct_productos = "0";
if (isset($_GET["recordID"])) {
  $varProduct_productos = $_GET["recordID"];
}
mysql_select_db($database_conexion, $conexion);
$query_productos = sprintf("SELECT * FROM productos WHERE productos.id_producto = %s", GetSQLValueString($varProduct_productos, "int"));
$productos = mysql_query($query_productos, $conexion) or die(mysql_error());
$row_productos = mysql_fetch_assoc($productos);
$totalRows_productos = mysql_num_rows($productos);
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
 <script>
function foto_pro()
{
	self.name = 'opener';
	remote = open('foto_producto.php', 'remote', 'width=400,height=150,location=no,scrollbars=yes,menubars=no,toolbars=no,resizable=yes,fullscreen=no, status=yes');
 	remote.focus();
	}

</script>
<div id="principal">

<div id="cabezera">
<?php include('plantilla/cabezera.php'); ?>
</div>

<div id="menu">
<?php include('plantilla/menu.php'); ?>
</div>

<div id="contenido">

<div id="contenido_inter_titulo">
<div id="contenido_inter_texto" class="Titulo_negro">Editar Producto</div>
<div id="contenido_inter_anterior" align="right"><a href="javascript:history.back()" class="Texto"><em>&lt;&lt; Regresar </em></a></div>
</div>

<div id="contenido_inter_datos">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="700" align="center" class="Texto">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Foto:</td>
        <td><input name="foto" type="text" class="casillas" value="<?php echo htmlentities($row_productos['foto'], ENT_COMPAT, 'utf-8'); ?>" size="32" />
          <input name="button4" type="button" id="button4" value="Subir foto" onclick="javascript:foto_pro();"/></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><input name="nombre" type="text" class="casillas" value="<?php echo htmlentities($row_productos['nombre'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Descripcion:</td>
        <td><textarea name="descripcion" cols="50" rows="5" class="casillas"><?php echo htmlentities($row_productos['descripcion'], ENT_COMPAT, 'utf-8'); ?></textarea></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Categoria:</td>
        <td><label for="categoria"></label>
          <select name="categoria" id="categoria">
            <?php
do {  
?>
            <option value="<?php echo $row_categoria['id_categoria']?>"><?php echo $row_categoria['nombre']?></option>
            <?php
} while ($row_categoria = mysql_fetch_assoc($categoria));
  $rows = mysql_num_rows($categoria);
  if($rows > 0) {
      mysql_data_seek($categoria, 0);
	  $row_categoria = mysql_fetch_assoc($categoria);
  }
?>
          </select></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Precio:</td>
        <td><input name="precio" type="text" class="casillas" value="<?php echo htmlentities($row_productos['precio'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Editar" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_update" value="form1" />
    <input type="hidden" name="id_producto" value="<?php echo $row_productos['id_producto']; ?>" />
  </form>
  <p>&nbsp;</p>
</div>

</div>
</div>

<div id="pie"><?php include('plantilla/pie.php'); ?></div>

</body>
</html>
<?php
mysql_free_result($categoria);

mysql_free_result($productos);
?>
