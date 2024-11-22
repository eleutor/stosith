<?php
    require_once('modelo/bbdd.php');
if (isset($_POST['userUser']) and isset($_POST['cargoUser']) and isset($_POST['nameUser']) and isset($_POST['lastnameUser'])) {
    $userUser = $_POST['userUser'];
    $cargoUser = $_POST['cargoUser'];
    $nombreUser = $_POST['nameUser'];
    $lastnameUser = $_POST['lastnameUser'];
    $imgUser = (isset($_FILES['imgUser'])) ? $_FILES['imgUser']['name']:false;
    #var_dump($imgUser);
    $updateUser = updateUser($nombreUser, $lastnameUser,$userUser, $imgUser);
    $dir = "/crudTareas/img/profiles/";
    $destino = $_SERVER["DOCUMENT_ROOT"] . $dir . basename($_FILES["imgUser"]["name"]);
    #print_r($destino);
    if ($updateUser) {
        move_uploaded_file($_FILES['imgUser']['tmp_name'],$destino);
        header('location:index.php');
    }
    else {
        header('location:index.php?fail=1.1');
    }
}


