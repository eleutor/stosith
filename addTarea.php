<?php
    require_once('modelo/bbdd.php');
    require_once('inc/validaciones.php');
if (isset($_POST['nameTarea']) 
and isset($_POST['proyectTarea']) 
and isset($_POST['personalTarea']) 
and isset($_POST['datiniTarea']) 
and isset($_POST['datentTarea']) 
and isset($_POST['descTarea'])) {

    $nameTarea = recogePost('nameTarea');
    #echo $nameTarea;
    $proyectTarea = recogePost('proyectTarea');
    $personalTarea = recogeMatriz('personalTarea');
    $datiniTarea = recogePost('datiniTarea');
    $datentTarea = recogePost('datentTarea');
    $descTarea = recogePost('descTarea');
    
    $addTarea = addTarea($nameTarea, $proyectTarea,$personalTarea, $datiniTarea, $datentTarea, $descTarea);
    #print_r($addTarea);
    if ($addTarea) {
        header('location:index.php');
    }
    else {
        header('location:index.php?fail=3');
    }
}
