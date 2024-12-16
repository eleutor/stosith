<?php

require_once("../plantillas/encabezado.php");
?>
<div class="container-fluid bg-warning text-dark ">  
    <div class="row">
        <div class="column ">
            <h1 class="display-2 text-center">STOSITH</h1>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-4">
            <form action="checklogin.php" method="POST">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">NIF</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="usuario">
                <?php
                    if (isset($_GET['error']) and  $_GET['error'] == 0) {
                        echo "<div id='emailHelp' class='mt-2 alert alert-danger alert-dismissible fade show' role='alert'>Usuario o contraseña incorrecta  
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button></div>";
                    }
                ?>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="exampleInputPassword1" name="password">
            </div>
            <!--
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Check me out</label>
            </div>
                -->
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-warning">Iniciar</button><a class="text-dark mt-2 ms-4" href="register.php">No estás registrado? Regístrate!</a>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once("../plantillas/pie.php");
?>
