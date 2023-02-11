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

mysql_select_db($database_conexion, $conexion);
$query_Categorias = "SELECT * FROM categoria_ind";
$Categorias = mysql_query($query_Categorias, $conexion) or die(mysql_error());
$row_Categorias = mysql_fetch_assoc($Categorias);
$totalRows_Categorias = mysql_num_rows($Categorias);
?>
<div id="categoria_agregar"  ><a href="agregar_industrial.php"  class="Titulo_negro"><strong>Agregar </strong> Categorias</a></div>
<!------------------------------------------------------------------- Categorias ------------------------------------------------------------------->

<?php do { ?>
  <div id="botones_submenu">
    <div id="botones_submenu_link">
      <a href="catalogo_ind.php?cat=<?php echo $row_Categorias['id_categoria']; ?>" class="Texto"><?php echo $row_Categorias['nombre']; ?></a>
    </div>
    <div id="botones_submenu_editar"><a href="editar_categoria_ind.php?recordID=<?php echo $row_Categorias['id_categoria']; ?>"><img src="imagenes/editar.png" width="16" height="16" border="0" /></a></div>
    <div id="botones_submenu_eliminar"> <a href="eliminar_categoria_ind.php?recordID=<?php echo $row_Categorias['id_categoria']; ?>"><img src="imagenes/eliminar.png" width="16" height="16" border="0" /></a></div>
  </div>
  <?php } while ($row_Categorias = mysql_fetch_assoc($Categorias)); ?>
<?php
mysql_free_result($Categorias);
?>
