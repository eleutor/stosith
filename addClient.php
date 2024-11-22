<?php
    require_once('modelo/bbdd.php');
    require_once('inc/validaciones.php');
    #print_r($_POST);
if (isset($_POST['nifClient']) and isset($_POST['nameClient']) and isset($_POST['passwdClient']) and isset($_POST['emailClient']) and isset($_POST['addressClient'])) {
    
    $failu = "";
    $addClient = "";

    $nifClient = recogePost('nifClient');
    $nameClient = recogePost('nameClient');
    $passwdClient = recogePost('passwdClient');
    $emailClient = recogePost('emailClient');
    $addressClient = recogePost('addressClient');
    if (!valid_nif($nifClient)) {
        $failu = 'nif';
    }
    elseif (!valid_passwd($passwdClient)) {
        $failu = 'passwd';
    }
    elseif (!valid_email($emailClient)) {
        $failu = 'email';
    }    
    elseif (!valid_address($addressClient)) {
        $failu = 'address';
    }
    print_r($failu);
    if (!$failu) {
        $addClient = addClient($nifClient, $nameClient, $passwdClient, $emailClient, $addressClient);
    }
    if ($addClient) {
        header('location:index.php');
    }
    else {
        header('location:index.php?fail='.$failu.'');
    }
    print_r($_POST);
}
