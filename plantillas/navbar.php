<nav class="navbar navbar-expand-sm bg-body-tertiary">
    <div class="container-fluid ">
      <h4> <span class="navbar-brand badge text-bg-warning"><?php echo $_SESSION['rol'] ?></span></h4>
      <a class="navbar-brand"><?php echo $_SESSION['usuario'] ?></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse " id="navbarSupportedContent" >
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Buscar" aria-label="Search" disabled>
          <button class="btn btn-outline-warning" type="submit" disabled>
            <span class="material-symbols-outlined">search</span>
          </button>
        </form>
        <ul class="navbar-nav me-auto mb-2 mr-2 mb-lg-0 w-100 justify-content-end">
            <?php 
                if (($_SESSION['rol'] == 'administrador')) {
                  ?>        
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php?optionav=1">Clientes</a>
                    </li>
                    <?php  
                }
                if (($_SESSION['rol'] == 'cliente')) {
                    ?>        
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./index.php?optionav=2">Certificados revocados</a>
                    </li>
                    <?php
                }
                $infoPerfil = infoPerfil($_SESSION['usuario']);?>
          
          <!--<li class="nav-item">
            <a class="nav-link" href="./index.php?optionav=3">Tareas</a>
          </li>-->
          <li class="nav-item dropdown">
            <a class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
              <?php
              if (empty($infoPerfil['img'])) {
                echo "<img src='img/perfil.svg' alt='pic' width='36' height='36' class='rounded-circle'>";
              }
              else {
                echo "<img src='img/profiles/".$infoPerfil['img']."' alt='pic' width='36' height='36' class='rounded-circle'>";
              }
              ?>
              
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-end">
                <li><a class="dropdown-item btn btn-primary" href="#" role="button" class="" data-bs-toggle="modal" data-bs-target="#infoPerfil">Perfil</a></li>
                <?php 
                    if ($_SESSION['rol'] == 'administrador') {
                        ?>        
                        <li><a class="dropdown-item" href="http://localhost/phpmyadmin/index.php" target="_blank">Base de datos</a></li>
                        <?php
                    }?>
                <li><hr class="dropdown-divider"></li> 
                <li><a class="dropdown-item" href="login/logout.php" >
                    <span class="material-symbols-outlined">logout</span>
                </a>
                </li>
            </ul>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li class="nav-item">
            <a class="nav-link" href="login/login.php"><link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@40,400,0,0" />
            <span class="material-symbols-outlined"></span></a>
          </li>
        </ul>        
      </div>
    </div>
  </nav>
  <body>
    <!-- ModalPerfil -->
    <div class="modal fade" id="infoPerfil" tabindex="-1" aria-labelledby="infoPerfilLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="infoPerfilLabel"><?php echo $infoPerfil['username']?></h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="updateUser.php" method="POST" enctype="multipart/form-data">
              
              <div class="mb-3">
                <label for="recipient-user" class="col-form-label">User:</label>
                <input type="text" class="form-control" id="recipient-usernamep" name="usernameClient" value="<?php echo $infoPerfil['username']?>" readonly>
              </div>
              <div class="mb-3">
                <label for="recipient-cargo" class="col-form-label ">Rol: </label>
                <input type="text" class="form-control" id="recipient-rolp" name="rolClient" value="<?php echo $infoPerfil['rol']?>" readonly>
              </div>
              <div class="mb-3">
                <label for="recipient-email" class="col-form-label">Email: </label>
                <input type="text" class="form-control" id="recipient-emailp" name="emailClient" value="<?php echo $infoPerfil['email']?>">
              </div>
              <hr class="dropdown-divider">
              <div class="modal-footer">
                <button type="submit" class="btn btn-warning" ><span class="material-symbols-outlined">brush</span></button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    