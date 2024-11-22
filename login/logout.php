<?php

session_start();

session_destroy(); #eliminamos la sesión
$_SESSION = []; #borramos las variables de la sesión
setcookie(session_name(), 123, time() -120); #eliminamos la cookie identificadora de la sesion que se crea y no vemos
header('location:../index.php');