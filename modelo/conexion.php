<?php
require_once('config.php'); #similar al include

function dbConnect () {
    #require_once('config.php');
    try {
        $baseConect = new PDO("mysql:host=".HOST.";dbname=".DBNAME,USER,PASS);
        $baseConect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }catch (PDOException $e) {
        #echo $e->getMessage();
        $baseConect= false;
    }
    return $baseConect;
}


?>