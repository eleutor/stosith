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
    $usuario = $_SESSION['usuario'];
  }
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
      if (!isset($_GET['optionav'])) {
        #print_r($page);
        ShowDominios($page,$nent);
      }
      elseif  ($_GET['optionav'] == 1) {
        #print_r($page);
        #print_r($nent);
        ShowDominios($page,$nent);
      }
      elseif  ($_GET['optionav'] == 2) {
        #print_r($page);
        #print_r($nent);
        ShowCertificados($page,$nent);
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
        <form action="addCert.php" method="POST">
          <div class="mb-3">
            <label for="recipient-ello" class="col-form-label">Dominio</label>
            <?php 
            if ($_SESSION['usuario']) {?>
              <select class="form-select" aria-label="Default select example" id="recipient-coord" name="coordProyect" required>
                <option selected disabled>Selecciona o dominio</option>
                <?php 
                  $infoDominios = infoDominios($_SESSION['usuario']);
                
                  foreach ($infoDominios as $c) {
                      echo "<option value='".$c['COD_Dom']."'>".$c['NombreDom']."</option>";
                    
                  } 
                ?>
                </select><?php 
            }?>

          </div>
          <div class="mb-3">
            <label for="recipient-cargo" class="col-form-label">Tipo</label>
            <select class="form-select" aria-label="Default select example" id="recipient-tipo" name="tipoCertificado" required>
              <option selected>Selecciona o tipo</option>
              <option value="">email</option>
              <option value="">server</option>
              <option value="">tarxeta identificativa</option>

            </select>
          </div>
          <div class="mb-3">
            <label for="recipient-ello" class="col-form-label">URL/E-mail/DNI:</label>
            <input type="text" class="form-control" id="recipient-ello" name="elloCertificado" placeholder="www.ejemplo.com ou user@prueba.es ou 42156854A" required>
          </div>
          <hr class="dropdown-divider">
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Xerar</button>
          </div>
        </form>
      </div>
      
    </div>
  </div>
</div>

<!--MODAL ADDdominio -->

<div class="modal fade" id="addDominio" tabindex="-1" aria-labelledby="addUserLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addUserLabel">Engadir dominio</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="addDom.php" method="POST">
          <div class="mb-3">
            <label for="recipient-ello" class="col-form-label">Nome</label>
            <input type="text" class="form-control" id="recipient-ello" name="elloCertificado" placeholder="prueba.com" required>
          </div>
          <hr class="dropdown-divider">
          <div class="modal-footer">
            <button type="submit" class="btn btn-warning">Xerar</button>
          </div>
        </form>
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
                  $coordinadores = infoDominios($_SESSION['usuario']);
                
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