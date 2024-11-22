<?php
session_start();
require_once('../modelo/bbdd.php'); #para poder usar las funciones checkUser y checkRole

if (isset($_POST['usuario']) and isset($_POST['password'])) {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];
    $dbUsuario = checkUser($usuario, $password);
    if ($dbUsuario) {
        $dbRole = checkRol($usuario);
        $_SESSION = [ 
            "usuario" => $usuario,
            "rol" => $dbRole,
        ];
        header("location:../index.php");
        
    }
    else {
        header("location:login.php?error=0");

    }

}


?>