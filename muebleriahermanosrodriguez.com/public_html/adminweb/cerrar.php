<?php require_once('Connections/conexion.php'); ?>
<?php 
    $_SESSION['MM_Username'] = "";
    $_SESSION['MM_UserGroup'] = "";	      

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Administrador</title>
<link href="plantilla/estilos.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #fff;
}
</style>
</head>

<body>

<div id="panel_admin_logo" align="center">
<p><a href="http://www.impulso-web.com" target="_blank"><img src="../imagenes/link.png" width="220" height="40" /></a></p>
<p class="Titulo_negro">Acceder al panel de control</p>
</div>

<div id="panel_admin_pass">
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="4">
      <tr>
        <td width="71%" align="center" class="Titulo_negro"><img src="../imagenes/link.png" width="220" height="40" /></td>
      </tr>
      <tr>
        <td width="71%" align="center" class="Titulo_negro">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><label for="user"><span class="Titulo_negro">Haz cerrado sesión</span></label></td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td align="center"><a href="index.php" class="boton">Volver acceder</a></td>
      </tr>
    </table>
</div>
<p class="Texto" align="center">© 2013 Derechos Reservados</p>
</body>
</html>