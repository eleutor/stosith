<?php
require_once ('modelo/bbdd.php');



function showPerfil() {

    $infoPerfil =  infoPerfil($_SESSION['usuario']);
        if ($infoPerfil) {
            #print_r($infoPerfil);
            foreach ($infoPerfil as $values) {
                $idUsuario = $values['idUsuario'];
                $idCargo = $values['idCargo'];
                $nombreUsuario = $values['nombreUsuario'];  
                $nombre = $values['nombre'];
                $apellidos = $values['apellidos'];
                
            }     

        }                
        
}

function ShowUsers($page,$nent) {
    
    
    $infoUser =  infoUser($page, $nent);
    #print_r($infoUser);
        if ($infoUser) {
             ?>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center"> 
                    <div class="col-8">
                        <h2 class="text-warning">Clientes</h2>
                        <table class='table table-hover'>
                        <thead class="">
                            <tr>
                        <?php
                            echo "<th scope='col'>Cargo</th>";
                            echo "<th scope='col'>User</th>";
                            echo "<th scope='col'>Nombre</th>";
                            echo "<th scope='col'>Apellidos</th>";
                            
                            ?> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($infoUser as $values) {
                                echo "<tr role='button' data-bs-toggle='modal' data-bs-target='#infoUser' >";                                   
                                    echo "<td>".$values['cargo']."</td>";
                                    echo "<td>".$values['nombreUsuario']."</td>";
                                    echo "<td>".$values['nombre']."</td>";
                                    echo "<td>".$values['apellidos']."</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center text-warning" id="paginacion">
                            <li class="page-item <?php if ($page == 1) { echo 'disabled';};?>">
                                <a class="page-link" href="<?php echo 'index.php?page='.($page -1);?>">Anterior</a>
                            </li>
                            <?php 
                            $totalUsers = totalClientes();
                            #print_r($totalUsers);
                            $totalPages = ceil($totalUsers['count(*)']/$nent);
                            $firstPage = ($page != 1) ? $page-1:1;
                            $lastPage = ($page != $totalPages) ? $page+1:$totalPages;
                            for ($i=$firstPage; $i<=$lastPage; $i++) {
                                ?><li class="page-item"><a class="page-link <?php if ($i == $page) { echo "active"; } ?>" href="<?php echo 'index.php?page='.$i;?>"><?php echo $i; ?></a></li><?php


                            }?>
                            <li class="page-item">
                            <a class="page-link <?php if ($page == $totalPages) { echo 'disabled';};?>" href="<?php echo 'index.php?page='.($page +1);?>">Siguiente</a>
                            </li>
                        </ul>
                        </nav>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addUser">Añadir usuario</button>
                    </div>
                </div>
            </div> <?php
        }
}

function ShowTareas() {

    $infoTareas =  infoTareas($_SESSION['usuario'],$_SESSION['rol']);
        if ($infoTareas) {
            ?>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-8 justify-text-center">
                        <h2 class="text-warning">Tareas</h2>
                        <table class='table table-hover '>
                        <thead>
                            <tr>
                        <?php
                            /*foreach ($CamposName as $cn) {
                                echo "<th scope='col'>$cn</th>";
                            }*/
                            echo "<th scope='col'>Nombre</th>";
                            echo "<th scope='col'>Coordinador</th>";
                            echo "<th scope='col'>Proyecto</th>";
                            echo "<th scope='col'>Fecha Inicio</th>";
                            echo "<th scope='col'>Fecha Final</th>";

                            ?>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($infoTareas as $values) {
                                echo "<tr role='button' data-bs-toggle='modal' data-bs-target='#infoTareas'>";
                                    #foreach ($values as $value ) {
                                    #    echo "<td>$value</td>";
                                    #}                       
                                    echo "<td>".$values['nombre']."</td>";
                                    echo "<td>".$values['coordinador']."</td>";
                                    echo "<td>".$values['proyecto']."</td>";
                                    echo "<td>".$values['fechaInicio']."</td>";
                                    echo "<td>".$values['fechaEntrega']."</td>";        

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        </table>
                        <?php 
                        if ($_SESSION['rol'] != 'Personal') { ?>
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addTarea">Añadir tarea</button><?php
                        }?>
                    </div>
                </div>
            </div> <?php
        }
}


function ShowCertificadosV() {

    $chckRole = $_SESSION['rol'];
    if ($chckRole == 'Administrador') {
        $infoCertificadosV = infoCertificadosV();
    }
    else {
        $infoCertificadosV =  infoCertificadosV($_SESSION['usuario']);    
    }
    
        if ($infoCertificadosV) {
            ?>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center">
                    <div class="col-8 justify-text-center">
                        <h2 class="text-warning">Certificados vigentes</h2>
                        <table class='table table-hover '>
                        <thead>
                            <tr>
                        <?php
                            /*foreach ($CamposName as $cn) {
                                echo "<th scope='col'>$cn</th>";
                            }*/
                            echo "<th scope='col'>Tipo</th>";
                            echo "<th scope='col'>Email</th>";
                            echo "<th scope='col'>Fecha Inicio</th>";
                            echo "<th scope='col'>Caducidad</th>";                         

                            ?>    
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($infoCertificadosV as $values) {
                                echo "<tr role='button' data-bs-toggle='modal' data-bs-target='#infoTareas'>";
                                    #foreach ($values as $value ) {
                                    #    echo "<td>$value</td>";
                                    #}                       
                                    echo "<td>".$values['tipo']."</td>";
                                    echo "<td>".$values['emailCliente']."</td>";
                                    echo "<td>".$values['fecha_registro']."</td>";
                                    echo "<td>".$values['fecha_caducidad']."</td>";                                         

                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                        </table>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addCertificado">Nuevo certificado</button>
                        
                    </div>
                </div>
            </div> <?php
        } 
        else {
            
    }   

}

#####################################################################################
####################################
#####################################################################################
####################################

function ShowClients($page,$nent) {
    
    
    $infoClients =  infoClients($page, $nent);
    #print_r($infoClients);
        if ($infoClients) {
             ?>
            <div class="container-fluid mt-4">
                <div class="row justify-content-center"> 
                    <div class="col-8">
                        <h2 class="text-warning">Clientes</h2>
                        <table class='table table-hover'>
                        <thead class="">
                            <tr>
                        <?php
                            echo "<th scope='col'>NIF</th>";
                            echo "<th scope='col'>Nombre</th>";
                            echo "<th scope='col'>Email</th>";
                            echo "<th scope='col'>Direccion</th>";
                            
                            ?> 
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($infoClients as $values) {
                                echo "<tr role='button' data-bs-toggle='modal' data-bs-target='#infoUser' >";                                   
                                    echo "<td>".$values['NIF']."</td>";
                                    echo "<td>".$values['name']."</td>";
                                    echo "<td>".$values['email']."</td>";
                                    echo "<td>".$values['address']."</td>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                        </table>
                        <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center text-warning" id="paginacion">
                            <li class="page-item <?php if ($page == 1) { echo 'disabled';};?>">
                                <a class="page-link" href="<?php echo 'index.php?page='.($page -1);?>">Anterior</a>
                            </li>
                            <?php 
                            $totalClients = totalClients();
                            #print_r($totalUsers);
                            $totalPages = ceil($totalClients['count(*)']/$nent);
                            $firstPage = ($page != 1) ? $page-1:1;
                            $lastPage = ($page != $totalPages) ? $page+1:$totalPages;
                            for ($i=$firstPage; $i<=$lastPage; $i++) {
                                ?><li class="page-item"><a class="page-link <?php if ($i == $page) { echo "active"; } ?>" href="<?php echo 'index.php?page='.$i;?>"><?php echo $i; ?></a></li><?php


                            }?>
                            <li class="page-item">
                            <a class="page-link <?php if ($page == $totalPages) { echo 'disabled';};?>" href="<?php echo 'index.php?page='.($page +1);?>">Siguiente</a>
                            </li>
                        </ul>
                        </nav>
                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addUser">Añadir cliente</button>
                    </div>
                </div>
            </div> <?php
        }
}
