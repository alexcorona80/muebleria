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

$maxRows_Productos = 10;
$pageNum_Productos = 0;
if (isset($_GET['pageNum_Productos'])) {
  $pageNum_Productos = $_GET['pageNum_Productos'];
}
$startRow_Productos = $pageNum_Productos * $maxRows_Productos;

mysql_select_db($database_conexion, $conexion);
$query_Productos = "SELECT * FROM productos";
$query_limit_Productos = sprintf("%s LIMIT %d, %d", $query_Productos, $startRow_Productos, $maxRows_Productos);
$Productos = mysql_query($query_limit_Productos, $conexion) or die(mysql_error());
$row_Productos = mysql_fetch_assoc($Productos);

if (isset($_GET['totalRows_Productos'])) {
  $totalRows_Productos = $_GET['totalRows_Productos'];
} else {
  $all_Productos = mysql_query($query_Productos);
  $totalRows_Productos = mysql_num_rows($all_Productos);
}
$totalPages_Productos = ceil($totalRows_Productos/$maxRows_Productos)-1;
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

<div id="submenu">
<?php include('plantilla/sub_menu.php'); ?>
</div>

<div id="contenido_inter">
<div id="contenido_inter_titulo">
<div id="contenido_inter_texto" class="Titulo_negro">Catalogo de productos</div>
<div id="contenido_inter_anterior" align="right"><a href="javascript:history.back()" class="Texto"><em>&lt;&lt; Regresar </em></a></div>
</div>
<!------------------------------------------------------------------------------------ Cabezera producto ------------------------------------------------------------------------------------------->
<div id="producto_agregar"  ><a href="agregar_producto.php"  class="Texto"><strong>Agregar </strong>Producto</a></div>
<div id="contenido_inter_cabezera">
<div class="Texto_blanco" id="contenido_inter_id">#</div>
<div class="Texto_blanco" id="contenido_inter_foto_cabezera">Foto del Producto</div>
<div class="Texto_blanco" id="contenido_inter_nombre">Nombre del Producto</div>
<div class="Texto_blanco" id="contenido_inter_descripcion">Descripcion del producto</div>
</div>
<!------------------------------------------------------------------------------------ producto ------------------------------------------------------------------------------------------->
<?php do { ?>
  <div id="contenido_inter_producto">
    <div class="Texto" id="contenido_inter_id"><?php echo $row_Productos['id_producto']; ?></div>
    <div id="contenido_inter_foto" align="center"><img src="../residencial/<?php echo $row_Productos['foto']; ?>"  height="100%" /></div>
    <div class="Texto" id="contenido_inter_nombre"><?php echo $row_Productos['nombre']; ?></div>
    <div class="Texto" id="contenido_inter_descripcion"><?php echo $row_Productos['descripcion']; ?></div>
    <div id="botones_submenu_editar"><a href="editar_producto.php?recordID=<?php echo $row_Productos['id_producto']; ?>"><img src="imagenes/editar.png" width="16" height="16" border="0" title="Editar Producto"/></a></div>
    <div id="botones_submenu_eliminar"> <a href="eliminar_producto.php?recordID=<?php echo $row_Productos['id_producto']; ?>"><img src="imagenes/eliminar.png" width="16" height="16" border="0" title="Eliminar Producto"/></a></div>
  </div>
  <?php } while ($row_Productos = mysql_fetch_assoc($Productos)); ?>
<!------------------------------------------------------------------------------------ producto ------------------------------------------------------------------------------------------->
<div id="contenido_inter_cabezera"></div>
<!------------------------------------------------------------------------------------ paginacion ------------------------------------------------------------------------------------------->

</div>
</div>
</div>

<div id="pie"><?php include('plantilla/pie.php'); ?></div>

</body>
</html>
<?php
mysql_free_result($Productos);
?>
