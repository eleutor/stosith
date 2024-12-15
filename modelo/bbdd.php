<?php

require_once('conexion.php');

function checkUser ($usuario, $password){
    try {
        $baseConect = dbConnect();
        $query = "select password from clientes where NIF=?";
        #$query = "select password from administradores where username=?";
        $sentencia = $baseConect->prepare($query);
        $sentencia->execute([$usuario]);
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
        $passwd_hash = $result['password'];
        $chckpasswd = password_verify($password, $passwd_hash);
        if (!empty($result) and $chckpasswd) {
            $value= true;
        } else {
            $value= false;
            #echo "No existe dicho usuario";
        }
    } catch (PDOException $e) {
        #echo "Error al comprobar el usuario: ".$e->getMessage();
        $value = false;
    }
    return $value;
}

/*function checkRol($usuario) {
    try {
        $baseConect = dbConnect();
        $queryCliente = "
            SELECT r.nombre AS nameRol 
            FROM Roles r 
            JOIN Clientes c ON r.cod = c.rol_id 
            WHERE c.NIF = ?
        ";
        $sentenciaCliente = $baseConect->prepare($queryCliente);
        $sentenciaCliente->execute([$usuario]);
        $resultCliente = $sentenciaCliente->fetch(PDO::FETCH_ASSOC);

        if (!empty($resultCliente)) {
            // Si encuentra el usuario en Clientes, devuelve su rol
            return $resultCliente['nameRol'];
        }
        // Si no es cliente, consulta en la tabla de administradores
        $queryAdmin = "
            SELECT r.nombre AS nameRol 
            FROM Roles r 
            JOIN Administradores a ON r.cod = a.rol_id 
            WHERE a.username = ?
        ";
        $sentenciaAdmin = $baseConect->prepare($queryAdmin);
        $sentenciaAdmin->execute([$usuario]);
        $resultAdmin = $sentenciaAdmin->fetch(PDO::FETCH_ASSOC);

        if (!empty($resultAdmin)) {
            // Si encuentra el usuario en Administradores, devuelve su rol
            return $resultAdmin['nameRol'];
        }
        // Si no encuentra el usuario en ninguna de las tablas, devuelve false
        return false;
    } catch (PDOException $e) {
        // Opcional: registra el error si es necesario
        // echo "Error al comprobar el rol: " . $e->getMessage();
        return false;
    }
}

function totalClientes () {
    try {
        $baseConect = dbConnect();
        $query = "select count(*) from clientes;";
        $sentencia = $baseConect->prepare($query);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        $result = false;
    }
    return $result;
}*/

function infoPerfil ($usuario){
    try {
        
        $baseConect = dbConnect();
        $query = "select * from clientes where NIF=?;";
        $sentencia = $baseConect->prepare($query);
        $sentencia->execute([$usuario]);
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

function infoUser ($page=false,$nent=false) {
    try {
        $baseConect = dbConnect();
        if (($page) and ($nent)) {
            $offset = ($page-1) * $nent;
            $query = "select a.*,b.nombreRol as rol 
            from usuarios a join roles b on a.idRol=b.idRol
            limit :limit offset :offset ";
            $sentencia = $baseConect->prepare($query);
            $sentencia->bindValue(':limit', (int) $nent, PDO::PARAM_INT);
            $sentencia->bindValue(':offset',(int) $offset, PDO::PARAM_INT);
            $sentencia->execute();
        }
        else {
            $query = "select a.*,b.nombreRol as rol 
            from usuarios a join roles b on a.idRol=b.idRol";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute();
        }
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

function infoTareas ($usuario,$rol) {
    try {
        $baseConect = dbConnect();
        if ($rol == 'Personal') {
            $query = "select a.*,c.nombreUsuario as 'Personal asignado',
            d.nombre as proyecto,e.nombreUsuario as coordinador 
            from tareas a 
            join usuariotarea b 
                on a.idTarea=b.idTarea 
            join usuarios c 
                on b.idUsuario=c.idUsuario
            join proyectos d 
                on a.idProyecto=d.idProyecto
            join usuarios e 
                on d.idCoord=e.idUsuario
            where c.nombreUsuario=?;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute([$usuario]);
        }
        elseif ($rol == 'Administrador') {
            $query = "select distinct a.*,
            d.nombre as proyecto,e.nombreUsuario as coordinador 
            from tareas a 
            join usuariotarea b 
                on a.idTarea=b.idTarea 
            join usuarios c 
                on b.idUsuario=c.idUsuario
            join proyectos d 
                on a.idProyecto=d.idProyecto
            join usuarios e 
                on d.idCoord=e.idUsuario;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute();
        }
        elseif ($rol == 'Coordinador') {
            $query = "select a.*,
            c.nombreUsuario as 'Personal asignado',
            d.nombre as proyecto,
            e.nombreUsuario as coordinador
            from tareas a 
            join usuariotarea b 
                on a.idTarea=b.idTarea 
            join usuarios c 
                on b.idUsuario=c.idUsuario
            join proyectos d 
                on a.idProyecto=d.idProyecto
            join usuarios e 
                on d.idCoord=e.idUsuario
            where e.nombreUsuario=?;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute([$usuario]);
        }
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

function infoDominios ($usuario=false) {
    try {
        $baseConect = dbConnect();
        if ($usuario) {
            $query = "select a.*,b.email as emailCliente
            from dominios a
            join clientes b on a.COD_cliente=b.COD_cliente
            where b.NIF=?;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute([$usuario]);
        }
        /*else {
            $query = "select a.*,b.nombreUsuario as coordinador
            from proyectos a
            join usuarios b on a.idCoord=b.idUsuario;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute();
        }*/
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

function infoCertificados ($usuario=false) {
    try {
        $baseConect = dbConnect();
        if ($usuario) {
            $query = "select c.*,d.NombreDom as Dominio
            from certificados c join dominios d 
                on c.COD_Dom=d.COD_Dom 
            join clientes cl
                on d.COD_Cliente=cl.COD_Cliente
            where cl.NIF=?;";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute([$usuario]);
        }    
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

########################
#OPERACIONES USUARIOS
########################
function addUser($userUser, $cargoUser, $passwdUser, $nameUser, $lastnameUser) {
    try {
        $baseConect = dbConnect();
        $passwd = password_hash($passwdUser, PASSWORD_DEFAULT);
        $query = "insert into usuarios(nombreUsuario, idCargo, password, nombre, apellidos) values(?, ?, ?, ?, ?);";
        $sentencia = $baseConect->prepare($query);
        if (!$sentencia->execute([$userUser, $cargoUser, $passwd, $nameUser, $lastnameUser])) {
            $sentencia = false;
        }
        else {
            $sentencia = true;
        }
    } catch (PDOException $e) {
        $sentencia = false;
    }
    return $sentencia;
}

function updateUser($nombreUser, $lastnameUser, $userUser, $imgUser=false) {
    try {
        $baseConect = dbConnect();
        if ($imgUser) {
            $query = "update usuarios set nombre = ? , apellidos = ?, img = ? where nombreUsuario = ?;";
            $sentencia = $baseConect->prepare($query);
            if (!$sentencia->execute([$nombreUser, $lastnameUser,$imgUser, $userUser])) {
                $sentencia = false;
            }
            else {
                $sentencia = true;
            }
        }
        else {
            $query = "update usuarios set nombre = ? , apellidos = ? where nombreUsuario = ?;";
            $sentencia = $baseConect->prepare($query);
            if (!$sentencia->execute([$nombreUser, $lastnameUser, $userUser])) {
                $sentencia = false;
            }
            else {
                $sentencia = true;
            }
        }
    } 
    catch (PDOException $e) {
        $sentencia = false;
    }
    return $sentencia;
}

########################
#OPERACIONES TAREAS
########################

function addTarea($nameTarea, $proyectTarea, $personalTarea, $datiniTarea, $datentTarea, $descTarea) {
    try {
        $baseConect = dbConnect();
        $query = "insert into tareas(nombre, idProyecto, fechaInicio, fechaEntrega, descripcion) values(?, ?, ?, ?, ?);";
        $sentencia = $baseConect->prepare($query);
        if (!$sentencia->execute([$nameTarea, $proyectTarea, $datiniTarea, $datentTarea, $descTarea])) {
            $sentencia = false;
        }
        else {
            $sentencia = true;
            $query = "select idTarea from tareas where idProyecto= ? and nombre= ?";
            $sentencia = $baseConect->prepare($query);
            if (!$sentencia->execute([$proyectTarea, $nameTarea])) {
                $sentencia = false;
                #return $sentencia;
            }
            else {
                $idTarea = $sentencia->fetch(PDO::FETCH_ASSOC)['idTarea'];
                foreach ($personalTarea as $p) {
                    $query = "insert into usuariotarea(idTarea, idUsuario) values(?, ?);";
                    $sentencia = $baseConect->prepare($query);
                    if (!$sentencia->execute([$idTarea, $p])) {
                        $sentencia = false;
                        #return $idTarea;
                    }
                    else {
                        $sentencia = true;
                    }
                }
                
            }
        }
    } catch (PDOException $e) {
        $sentencia = false;
    }
    return $sentencia;
}

##########################
# OPERACIONES PROYECTOS
##########################

function addProyect($nameProyect, $coordProyect, $descProyect) {
    try {
        $baseConect = dbConnect();
        $query = "insert into proyectos(nombre, idCoord, descripcion) values(?, ?, ?);";
        $sentencia = $baseConect->prepare($query);
        if (!$sentencia->execute([$nameProyect, $coordProyect, $descProyect])) {
            $sentencia = false;
        }
        else {
            $sentencia = true;
        }
    } catch (PDOException $e) {
        $sentencia = false;
    }
    return $sentencia;
}


###############################################################
##############################################################
##################################################################

function addClient($nifClient, $nameClient, $passwdClient, $emailClient, $addressClient) {
    try {
        $baseConect = dbConnect();
        $passwdClient = password_hash($passwdClient, PASSWORD_DEFAULT);
        $query = "insert into Clientes (NIF, name, password, email, address) values(?, ?, ?, ?, ?);";
        $sentencia = $baseConect->prepare($query);
        if (!$sentencia->execute([$nifClient, $nameClient, $passwdClient, $emailClient, $addressClient])) {
            $sentencia = false;
        }
        else {
            $sentencia = true;
        }
    } catch (PDOException $e) {
        $sentencia = false;
    }
    return $sentencia;
}

function infoClients ($page=false,$nent=false) {
    try {
        $baseConect = dbConnect();
        if (($page) and ($nent)) {
            $offset = ($page-1) * $nent;
            $query = "select * from clientes
            limit :limit offset :offset ";
            $sentencia = $baseConect->prepare($query);
            $sentencia->bindValue(':limit', (int) $nent, PDO::PARAM_INT);
            $sentencia->bindValue(':offset',(int) $offset, PDO::PARAM_INT);
            $sentencia->execute();
        }
        else {
            $query = "select c.*,r.nombre as rol 
            from clientes c join roles r on c.rol_id=r.cod";
            $sentencia = $baseConect->prepare($query);
            $sentencia->execute();
        }
        $result = $sentencia->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $result = false;
    }
    return $result;
}

function totalClients () {
    try {
        $baseConect = dbConnect();
        $query = "select count(*) from clientes;";
        $sentencia = $baseConect->prepare($query);
        $sentencia->execute();
        $result = $sentencia->fetch(PDO::FETCH_ASSOC);
    }
    catch (PDOException $e) {
        $result = false;
    }
    return $result;
}