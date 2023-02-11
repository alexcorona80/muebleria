<?php require_once('../Connections/conexion.php'); 
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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['user'])) {
  $loginUsername=$_POST['user'];
  $password=$_POST['pass'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "administrador.php";
  $MM_redirectLoginFailed = "error.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_conexion, $conexion);
  
  $LoginRS__query=sprintf("SELECT user, pass FROM usuario WHERE user=%s AND pass=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $conexion) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
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
<p class="Titulo_negro">Acceder al panel de control</p>
</div>

<div id="panel_admin_pass">
<form id="form1" name="form1" action="<?php echo $loginFormAction; ?>" method="POST">
    <table width="100%" border="0" align="center" cellpadding="4" cellspacing="4">
      <tr>
        <td width="71%" align="center" class="Titulo_negro"><img src="../imagenes/logo.png"  /></td>
      </tr>
      <tr>
        <td align="center" class="Titulo_negro">&nbsp;</td>
      </tr>
      <tr>
        <td width="71%"><span class="Texto">Usuario :</span></td>
      </tr>
      <tr>
        <td><label for="user"></label>
        <input name="user" type="text" class="casillas_admin" id="user" /></td>
      </tr>
      <tr>
        <td><span class="Texto">Contraseña :</span></td>
      </tr>
      <tr><label for="pass"></label>
        <td><input name="pass" type="text" class="casillas_admin" /></td>
      </tr>
      <tr>
        <td align="center">
          <input  name="button" type="submit" class="boton"  id="button" value="Iniciar sesion">
</td>
      </tr>
    </table>
</form>
</div>
<p class="Texto" align="center">© 2013 Derechos Reservados</p>
</body>
</html>