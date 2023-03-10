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

mysql_select_db($database_conexion, $conexion);
$query_Productos = "SELECT * FROM productos";
$Productos = mysql_query($query_Productos, $conexion) or die(mysql_error());
$row_Productos = mysql_fetch_assoc($Productos);
$totalRows_Productos = mysql_num_rows($Productos);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

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
<META NAME="description" CONTENT="Muebleria Hermanos Rodriguez Rodriguez Tuxpan Nayarit, electrodomesticos en nayarit, tienda de electridomesticos, tienda de muebles para el hogar, tienda de muebles, muebleria economica,">
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
<div class="barra_flotante wow fadeInLeft"><?php include('barra_flotante.php'); ?></div>
<div id="pagina">
<!–––----------DATOS TOP------------––––>
 <div class="datos">
     <div class="plantilla_datos wow fadeInLeft"><?php include('datos.php'); ?></div>
 </div>
<!–––-------LOGO Y MENU-----––––>
 <div class="cabecera">
     <div class="plantilla_cabecera">
     	<div class="logo wow fadeInLeft"><img src="imagenes/logo.png"></div>
     	<div class="boton_dis wow fadeInLeft"><img src="imagenes/boton_movil.png"  id="boton"></div>
        <div class="menu wow fadeInLeft" align="center">
            <a href="index.php" class="active">Inicio</a>
            <a href="productos.php">Productos</a>
            <a href="conocenos.php">Conócenos</a>
            <a href="ubicacion.php">Ubicación</a>
        </div>
     </div>
 </div>
<!–––------BANNER------––––>
 <div class="banner"><img src="banner/1.jpg" width="100%"></div>
<!–––--------PRODUCTOS----––––>
<div class="contPro">
    <div class="contProInf wow fadeInLeft">
            <div class="subMenu"><?php include('submenu.php'); ?></div>
            <div class="catPro">

                    <?php do { ?>
                        <div>
                           <a href="detalles.php?cat=<?php echo $row_Productos['id_producto']; ?>"><img src="productos/<?php echo $row_Productos['foto']; ?>" width="100%"></a>
                           <p align="center"><?php echo $row_Productos['nombre']; ?></p>
                        </div>
                      <?php } while ($row_Productos = mysql_fetch_assoc($Productos)); ?>

            </div>
    </div>
</div>
<!–––------------––––>
 <div class="pie">
     <div class="plantilla_pie wow fadeInLeft"><?php include('pie.php'); ?></div>
 </div>
<!–––------------––––>
 </div>
<?php include('menu_tablet_cel.php'); ?>
<script src="js/wow.min.js"></script>
<script> new WOW().init(); </script>
</body>
</html>
<?php
mysql_free_result($Productos);
?>
