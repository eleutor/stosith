<?php

// FUNCIÓN DE RECOGIDA DE UN DATO
function recogePost($var)
{
    $tmp = (isset($_POST[$var]))
        ? trim(htmlspecialchars($_POST[$var], ENT_QUOTES, "UTF-8"))
        : "";
    return $tmp;
}

// FUNCIÓN DE RECOGIDA DE UNA MATRIZ DE UNA DIMENSIÓN
function recogeMatriz($var)
{
    $tmpMatriz = [];
    if (isset($_REQUEST[$var]) && is_array($_REQUEST[$var])) {
        foreach ($_REQUEST[$var] as $indice => $valor) {
            $indiceLimpio = trim(htmlspecialchars($indice, ENT_QUOTES, "UTF-8"));
            $valorLimpio  = trim(htmlspecialchars($valor,  ENT_QUOTES, "UTF-8"));
            $tmpMatriz[$indiceLimpio] = $valorLimpio;
        }
    }
    return $tmpMatriz;
}

#VALIDACIONES USER

function valid_nombreUsuario($nombreUsuario) {
    return preg_match('/^[a-z\d]{1,25}+$/i', $nombreUsuario);
}

function valid_passwd($passwd) {
    return preg_match('/^[a-zA-Z0-9\!@#$&%\*\(\)\\-\.\+\,\/]{8,256}$/', $passwd);
}

function valid_nombre ($nombre) {
    return preg_match('/^[a-z\s]{1,30}+$/i', $nombre);
}

function valid_apellidos ($apellidos) {
    return preg_match('/^[a-z\s]{1,100}+$/i', $apellidos);
}

function valid_img ($img) {
    return preg_match('/^[a-zA-Z0-9\.\-\_\(\)]{1,254}+$/i', $img);
}

#VALIDACIONES CLIENTS

function valid_nif($nif) {
    return preg_match('/^[0-9]{8}[A-Z]$/i', $nif);
}

function valid_name($name) {
    return preg_match('/^[a-z\d]{1,25}+$/i', $name);
}

/*function valid_passwd($passwd) {
    return preg_match('/^[a-zA-Z0-9\!@#$&%\*\(\)\\-\.\+\,\/]{8,256}$/', $passwd);
}*/

function valid_email($email) {
    return preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/', $email);
}

function valid_address($address) {
    return preg_match('/^[a-zA-Z0-9\s.,#-]{1,100}$/', $address);
}

/*function valid_img ($img) {
    return preg_match('/^[a-zA-Z0-9\.\-\_\(\)]{1,254}+$/i', $img);
}*/