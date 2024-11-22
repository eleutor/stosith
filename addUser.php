<?php
    require_once('modelo/bbdd.php');
    require_once('inc/validaciones.php');
if (isset($_POST['userUser']) and isset($_POST['cargoUser']) and isset($_POST['passwdUser']) and isset($_POST['nameUser']) and isset($_POST['lastnameUser'])) {
    
    $failu = "";
    $addUser = "";

    $userUser = recogePost('userUser');
    $cargoUser = recogePost('cargoUser');
    $passwdUser = recogePost('passwdUser');
    $nameUser = recogePost('nameUser');
    $lastnameUser = recogePost('lastnameUser');
    if (!valid_nombreUsuario($userUser)) {
        $failu = 'user';
    }
    elseif (!valid_passwd($passwdUser)) {
        $failu = 'passwd';
    }
    elseif (!valid_nombre($nameUser)) {
        $failu = 'name';
    }    
    elseif (!valid_apellidos($lastnameUser)) {
        $failu = 'lastname';
    }
    if (!$failu) {
        $addUser = addUser($userUser, $cargoUser, $passwdUser, $nameUser, $lastnameUser);
    }
    if ($addUser) {
        header('location:index.php');
    }
    else {
        header('location:index.php?fail='.$failu.'');
    }
}
