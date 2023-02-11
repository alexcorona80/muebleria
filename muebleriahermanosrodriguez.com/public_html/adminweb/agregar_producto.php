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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO productos (foto, nombre, descripcion, categoria, precio) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['foto'], "text"),
                       GetSQLValueString($_POST['nombre'], "text"),
                       GetSQLValueString($_POST['descripcion'], "text"),
                       GetSQLValueString($_POST['categoria'], "int"),
                       GetSQLValueString($_POST['precio'], "text"));

  mysql_select_db($database_conexion, $conexion);
  $Result1 = mysql_query($insertSQL, $conexion) or die(mysql_error());

  $insertGoTo = "administrador.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_conexion, $conexion);
$query_categoria = "SELECT * FROM categoria";
$categoria = mysql_query($query_categoria, $conexion) or die(mysql_error());
$row_categoria = mysql_fetch_assoc($categoria);
$totalRows_categoria = mysql_num_rows($categoria);
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
<div id="contenido_inter_texto" class="Titulo_negro">Agregar Producto</div>
<div id="contenido_inter_anterior" align="right"><a href="javascript:history.back()" class="Texto"><em>&lt;&lt; Regresar </em></a></div>
</div>

<div id="contenido_inter_datos">
  <form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
    <table width="700" align="center" class="Texto">
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Foto:</td>
        <td><input name="foto" type="text" class="casillas" value="" size="32" />
          <input name="button4" type="button" id="button4" value="Subir foto" onclick="javascript:foto_pro();"/></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">Nombre:</td>
        <td><input name="nombre" type="text" class="casillas" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right" valign="top">Descripcion:</td>
        <td><textarea name="descripcion" cols="50" rows="5" class="casillas"></textarea></td>
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
        <td><input name="precio" type="text" class="casillas" value="" size="32" /></td>
      </tr>
      <tr valign="baseline">
        <td nowrap="nowrap" align="right">&nbsp;</td>
        <td><input type="submit" value="Insertar registro" /></td>
      </tr>
    </table>
    <input type="hidden" name="MM_insert" value="form1" />
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
?>
