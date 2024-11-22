<?php
    require_once('modelo/bbdd.php');
if (isset($_POST['nameProyect']) 
and isset($_POST['coordProyect']) 
and isset($_POST['descProyect'])) {

    $nameProyect = $_POST['nameProyect'];
    $coordProyect = $_POST['coordProyect'];
    $descProyect = $_POST['descProyect'];
    #print_r($_POST);
    $addProyect = addProyect($nameProyect, $coordProyect, $descProyect);
    #print_r($addProyect);
    if ($addProyect) {
        header('location:index.php');
    }
    else {
        header('location:index.php?fail=2');
    }
}