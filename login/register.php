<?php 
require_once("../plantillas/encabezado.php");
?>
<div class="container-fluid bg-warning text-dark ">  
    <div class="row">
        <div class="column ">
            <h1 class="display-2 text-center">stosithCA</h1>
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row justify-content-center mt-4">
        <div class="col-sm-4">
            <form action="../addClient.php" method="POST">
            <div class="mb-3">
                <label for="recipient-user" class="col-form-label">NIF:</label>
                <input type="text" class="form-control" id="recipient-nif" name="nifClient" required>
            </div>
            <div class="mb-3">
                <label for="recipient-user" class="col-form-label">Nombre:</label>
                <input type="text" class="form-control" id="recipient-name" name="nameClient" required>
            </div>
            <div class="mb-3">
                <label for="recipient-passwd" class="col-form-label">Contraseña:</label>
                <input type="password" class="form-control" id="recipient-passwd" name="passwdClient" required>
            </div>
            <div class="mb-3">
                <label for="recipient-chckpasswd" class="col-form-label">Vuelve a introducir la contraseña:</label>
                <input type="password" class="form-control" id="recipient-chckpasswd" name="chckpasswdClient" required>
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Email:</label>
                <input type="text" class="form-control" id="recipient-email" name="emailClient">
            </div>
            <div class="mb-3">
                <label for="recipient-lastname" class="col-form-label">Dirección:</label>
                <input type="text" class="form-control" id="recipient-address" name="addressClient">
            </div>
            <div class="mb-3">
                <label for="recipient-name" class="col-form-label">Teléfono:</label>
                <input type="text" class="form-control" id="recipient-phone" name="phoneClient">
            </div>
            <hr class="dropdown-divider">
            <div class="d-flex justify-content-center mb-3">
                <button type="submit" class="btn btn-warning">Registrarse</button>
            </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once("../plantillas/pie.php");
?>