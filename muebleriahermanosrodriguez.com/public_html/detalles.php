<?php require_once('connections/conexion.php'); ?>
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

$varPordos_prodctos = "0";
if (isset($_GET["cat"])) {
  $varPordos_prodctos = $_GET["cat"];
}
mysql_select_db($database_conexion, $conexion);
$query_prodctos = sprintf("SELECT * FROM productos WHERE productos.id_producto = %s", GetSQLValueString($varPordos_prodctos, "int"));
$prodctos = mysql_query($query_prodctos, $conexion) or die(mysql_error());
$row_prodctos = mysql_fetch_assoc($prodctos);
$totalRows_prodctos = mysql_num_rows($prodctos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="title" content="Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit">
<META NAME="audience" CONTENT="All">
<META NAME="Rating" CONTENT="General">
<meta name="language" content="Spanish" />
<meta name="distribution" content="Global" />
<meta http-equiv="pragma" content="no-cache" />
<meta name="searchtitle" content="Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit" />
<META NAME="keywords" CONTENT="'Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit', 'desarrollo web', 'páginas web', 'sitios web', 'diseño de páginas web', 'desarrollo de páginas web', 'desarrollo de sitios web', 'software', 'soluciones de software', 'desarrollo de software', 'software a la medida', 'páginas web Guadalajara', 'diseño web Guadalajara', 'sitios web Guadalajara', 'intranet', 'soluciones de intranet', 'portales de intranet', 'portal de intranet', 'intranet Guadalajara', 'intranet México', 'amdinistración de documentos', 'productividad empresarial', 'software de productividad empresarial', 'consultores de software', 'consultoría de sistemas', 'consultores de software México', 'consultores de software Guadalajara'">
<META NAME="description" CONTENT="Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit, Desarrollo de páginas web Guadalajara, diseño de sitios web y páginas Web, diseño web Guadalajara, tienda online, catálogo de productos y carrito de compras, portales de Intranet y CRM enGuadalajara, México">
<title>Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="css/base.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/menu_tablet_cel.js"></script>
    <link rel="shortcut icon" href="favicon.ico">
    <link rel="stylesheet" href="css/animate.css" />
<!--------------- CONTADOR DE VISITAS ----------->

<!----------------->
</head>
<body>
<!–––------MENU IZQUIERDO REDES SOCIALES------––––>
<div class="barra_flotante"><?php include('barra_flotante.php'); ?></div>
<div id="pagina">
<!–––----------DATOS TOP------------––––>
 <div class="datos">
     <div class="plantilla_datos"><?php include('datos.php'); ?></div>
 </div>
<!–––-------LOGO Y MENU-----––––>
 <div class="cabecera">
     <div class="plantilla_cabecera">
     	<div class="logo"><img src="imagenes/logo.png"></div>
     	<div class="boton_dis"><img src="imagenes/boton_movil.png"  id="boton"></div>
        <div class="menu" align="center">
            <a href="index.php">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="conocenos.php">Conócenos</a>
            <a href="ubicacion.php">Ubicación</a>
        </div>
     </div>
 </div>
<!–––--------PRODUCTOS----––––>
<div class="contPro">
    <div class="contProInf">
            <div class="subMenu"><?php include('submenu.php'); ?></div>
            <div class="detalles">

                        <div>
                           <img src="productos/<?php echo $row_prodctos['foto']; ?>" width="100%">  
                        </div>
                        <div>
                             <h1><?php echo $row_prodctos['nombre']; ?></h1>
                             <p><?php echo $row_prodctos['descripcion']; ?></p>
                             <p>$ <?php echo $row_prodctos['precio']; ?></p><br/><br/>
                             <p><a href="javascript:history.back()"><em>&lt;&lt; Regresar </em></a></p>
                        </div>
                        
            </div>
    </div>
</div>
<!–––------------––––>
 <div class="pie">
     <div class="plantilla_pie"><?php include('pie.php'); ?></div>
 </div>
<!–––------------––––>
 </div>
<?php include('menu_tablet_cel.php'); ?>
<script src="js/wow.min.js"></script>
<script> new WOW().init(); </script>
</body>
</html>
<?php
mysql_free_result($prodctos);
?>


