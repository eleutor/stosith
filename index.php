<?php
 session_start();
  require_once('inc/funciones.php');
  include('plantillas/encabezado.php');
  

 
  if (!isset($_SESSION['usuario'])) {
    #print_r($_SESSION);
    header('location:login/login.php');
  }
  else {
    require_once('plantillas/navbar.php');
    $rol = $_SESSION['rol'];

    ########################
    # FAILS
    ########################
      if (isset($_GET['fail'])) {
        $fail = $_GET['fail'];
        if  ($fail == 1) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Puñeta!</strong> No ha sido posible crear el nuevo usuario.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> <?php

        }
        elseif  ($fail == 2) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Puñeta!</strong> No ha sido posible crear el nuevo proyecto.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> <?php

        }
        elseif  ($fail == 3) { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Puñeta!</strong>No ha sido posible añadir la nueva tarea.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> <?php

        }
        else { ?>
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Puñeta!</strong> You should check in on some of those fields below.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div> <?php

        }
        
      }

###########################

    $page = isset($_GET['page']) ? $_GET['page']:1;
    
    $nent = 6;
    
    if ($rol == 'administrador') {
      #header('location:vistas/indexAdmin.php');
      if (!isset($_GET['optionav'])) {
        #print_r($page);
        ShowClients($page,$nent);
      }
      elseif  ($_GET['optionav'] == 1) {
        #print_r($page);
        #print_r($nent);
        ShowClients($page,$nent);
      }
      elseif  ($_GET['optionav'] == 2) {
        ShowCertificadosV();
      }
      elseif  ($_GET['optionav'] == 3) {
        ShowTareas();
      }
    }
    elseif ($rol == 'cliente') {
      #header('location:vistas/indexCoord.php');
      if (!isset($_GET['optionav'])) {
        ShowCertificadosV();
      }
      elseif  ($_GET['optionav'] == 1) {
        ShowUsers($page,$nent);
      }
      elseif  ($_GET['optionav'] == 2) {
        ShowCertificadosV();
      }
      elseif  ($_GET['optionav'] == 3) {
        ShowTareas();
      }
    }
    elseif ($rol == 'Personal') {
      #header('location:vistas/indexPerson.php');
      ShowTareas();
    }
  }

  include('plantillas/pie.php');
  ?>


<!-- MODAL ADD CERTIFICADO -->

<div class="modal fade" id="addCertificado" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addUserLabel">Solicitar certificado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addUser.php" method="POST">
          <div class="mb-3">
            <label for="recipient-cargo" class="col-form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="recipient-tipo" name="tipoCertificado" required>
              <option selected>Selecciona el cargo</option>
              <option value="">email</option>
              <option value="">web</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-ello" class="col-form-label">URL/E-mail:</label>
            <input type="text" class="form-control" id="recipient-ello" name="elloCertificado" placeholder="www.ejemplo.com o user@prueba.es" required>
          </div>
          <hr class="dropdown-divider">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success"><span class="material-symbols-outlined">person_add</span></button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>


<!-- Modal infouser -->


<div class="modal fade" id="infoUser" tabindex="-1" aria-labelledby="infoUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success text-white">
        <h1 class="modal-title fs-5" id="infoUserLabel">Información usuario</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
          <div class="mb-3">
            <label for="recipient-user" class="col-form-label">User:</label>
            <input type="text" class="form-control" id="recipient-user">
          </div>
          <div class="mb-3">
            <label for="recipient-cargo" class="col-form-label">Cargo</label>
            <select class="form-select" aria-label="Default select example" id="recipient-cargo">
              <option selected>Selecciona el cargo</option>
              <?php 
                $cargos = infoCargos();
                foreach ($cargos as $c) {
                  echo "<option value='".$c['idCargo']."'>".$c['nombreCargo']."</option>";
                } 
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-passwd" class="col-form-label">Contraseña:</label>
            <input type="text" class="form-control" id="recipient-passwd">
          </div>
          <div class="mb-3">
            <label for="recipient-chckpasswd" class="col-form-label">Vuelve a introducir la contraseña:</label>
            <input type="text" class="form-control" id="recipient-chckpasswd">
          </div>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="recipient-name" required>
          </div>
          <div class="mb-3">
            <label for="recipient-lastname" class="col-form-label">Apellidos</label>
            <input type="text" class="form-control" id="recipient-lastname" required>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-warning"><span class="material-symbols-outlined">brush</span></button>
        <button type="button" class="btn btn-danger"><span class="material-symbols-outlined">delete</span></button>
      </div>
    </div>
  </div>
</div>



<!-- Modal addTarea -->

<div class="modal fade" id="addTarea" tabindex="-1" aria-labelledby="addTareaLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addUserLabel">Nueva tarea</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addTarea.php" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="recipient-name" placeholder="Nueva Tarea" name="nameTarea">
          </div>
          <div class="mb-3">
            <label for="recipient-proyect" class="col-form-label">Proyecto</label>
            <select class="form-select" aria-label="Default select example" id="recipient-proyect" name="proyectTarea">
              <option selected>Selecciona el proyecto</option>
              <?php 
                if ($_SESSION['rol'] == "Administrador") {
                  $proyectos = infoCertificadosV();
                }
                else {
                  $proyectos = infoCertificadosV($_SESSION['usuario']);
                }
                foreach ($proyectos as $p) {
                  echo "<option value='".$p['idProyecto']."'>".$p['nombre']."</option>";
                } 
              ?>
            </select>
          </div>
          <div class="mb-3" >
            <label for="recipient-personal" class="col-form-label">Personal asignado:</label><br> 
            <?php                             
              $usuarios = infoUser();
              foreach ($usuarios as $u) {
                if ($u['cargo'] == 'Personal') {?>
                  <div class="form-check form-check-inline"  >
                    <input class="form-check-input" type="checkbox" value="<?php echo $u['idUsuario'];?>" id="flexCheckDefault" name="personalTarea[]">
                    <label class="form-check-label" for="flexCheckDefault"><?php echo $u['nombreUsuario'];?></label>
                  </div><?php
                }
              }?>
          </div>
          <div class="mb-3">
            <label for="recipient-datini" class="col-form-label">Fecha de inicio:</label>
            <input type="date" class="form-control" id="recipient-datini" name="datiniTarea">
          </div>
          <div class="mb-3">
            <label for="recipient-datent" class="col-form-label">Fecha de entrega:</label>
            <input type="date" class="form-control" id="recipient-datent" name="datentTarea">
          </div>
          <div class="mb-3">
            <label for="recipient-desc" class="col-form-label">Descripción:</label>
            <input type="text" class="form-control" id="recipient-desc" name="descTarea" placeholder="Descripción">
          </div>
          <hr class="dropdown-divider">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Añadir</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!-- Modal addPROYECT -->

<div class="modal fade" id="addProyect" tabindex="-1" aria-labelledby="addProyectLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addProyectLabel">Nuevo Proyecto</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addProyect.php" method="POST">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Nombre:</label>
            <input type="text" class="form-control" id="recipient-name" name="nameProyect" required>
          </div>
          <div class="mb-3">
            <label for="recipient-coord" class="col-form-label">Coordinador:</label>
            <?php 
            if ($_SESSION['rol'] == 'Administrador') {?>
              <select class="form-select" aria-label="Default select example" id="recipient-coord" name="coordProyect" required>
                <option selected disabled>Selecciona el coordinador</option>
                <?php 
                  $coordinadores = infoUser();
                
                  foreach ($coordinadores as $c) {
                    if ($c['cargo'] == 'Coordinador') {
                    echo "<option value='".$c['idUsuario']."'>".$c['nombreUsuario']."</option>";
                    }
                  } 
                ?>
              </select><?php 
            }
            else {
              $infoPerfil = infoPerfil($_SESSION['usuario'])?>
              <input type="text" class="form-control" id="recipient-coord" value="<?php echo $infoPerfil['nombreUsuario'];?>" readonly>
              <input type="hidden" name="coordProyect" value="<?php echo $infoPerfil['idUsuario'];?>"><?php 
            }  ?>
            
          </div>
          <div class="mb-3">
            <label for="recipient-desc" class="col-form-label">Descripción:</label>
            <input type="text" class="form-control" id="recipient-desc" name="descProyect" required>
          </div>
          <hr class="dropdown-divider">
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Crear</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>