<?php
    function conexionDB(){
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
        try{
            $mysqli = new mysqli("mysql", "noelia", "tiger54", "SIBW");
            $mysqli->set_charset("utf8mb4");
        } catch(Exception $e) {
            error_log($e->getMessage());
            exit('Fallo al conectar: '. $mysqli->connect_error);
        }

        return $mysqli;
    }

    function getEvento($idEv, $mysqli) {
        $stmt = $mysqli->prepare("SELECT id, nombre, lugar, fecha, descripcion, web, twitter, facebook, imagen, img_galeria1, img_galeria2, img_galeria3 FROM eventos WHERE id=?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();

        $res = $stmt->get_result();
        
        $evento = array('nombre' => 'Este evento no existe');
    
        if ($res->num_rows > 0) {
            $row = $res->fetch_assoc();
            $evento = array('id' => $row['id'], 'nombre' => $row['nombre'], 'lugar' => $row['lugar'], 'fecha' => $row['fecha'], 'descripcion' => $row['descripcion'], 'web' => $row['web'], 'twitter' => $row['twitter'], 'facebook' => $row['facebook'], 'imagen' => $row['imagen'], 'img_galeria1' => $row['img_galeria1'], 'img_galeria2' => $row['img_galeria2'], 'img_galeria3' => $row['img_galeria3']);
        }

        $res->close();

        return $evento;
    }

    function getPalabrasProhibidas($mysqli){
        $res = $mysqli->query("SELECT nombre FROM palabras_prohibidas");
        
        while ($fila = $res->fetch_row()){
            $palabras[] = $fila[0];
        }

        $res->close();

        $linea = "<div id=\"prohibidas\">";

        foreach ($palabras as $p){
            $linea .= $p;
            $linea .= "\n";
        }

        $linea .= "</div>";
        
        return $linea;
    }

    function checkLogin($mysqli, $nick, $pass) {
        $usu = $mysqli->query("SELECT nombre FROM usuarios");
        $p = $mysqli->query("SELECT pass FROM usuarios");

        while ($fila = $usu->fetch_row()){
            $usuarios[] = $fila[0];
        }

        $usu->close();

        while ($f = $p->fetch_row()){
            $passes[] = $f[0];
        }
        $p->close();

        $i=0;
        foreach ($usuarios as $u){
            if($u === $nick){
                if(password_verify($pass, $passes[$i])){
                    return true;
                }
            }
            $i++;
        }

        return false;
    }

    function getUser($mysqli, $nick) {
        $usu = $mysqli->query("SELECT nombre FROM usuarios");

        while ($fila = $usu->fetch_row()){
            $usuarios[] = $fila[0];
        }

        $usu->close();

        foreach ($usuarios as $u){
            if ($u === $nick){
                return $u;
            }
        }

        return 0;
    }

    function checkRegistry($mysqli, $nick, $email, $pass){
        $usu = $mysqli->query("SELECT nombre FROM usuarios");

        while ($fila = $usu->fetch_row()){
            $usuarios[] = $fila[0];
        }

        $usu->close();

        foreach ($usuarios as $u) {
            if ($u === $nick) {
                return false;
            }
        }

        $stmt = $mysqli->prepare("INSERT INTO usuarios (nombre, pass, anonimo, registrado, moderador, gestor, super, email) VALUES (?, ?, false, true, false, false, false, ?)");
        $stmt->bind_param("sss", $nick, password_hash($pass, PASSWORD_DEFAULT), $email);
        $stmt->execute();
        
        $stmt->close();
        return true;
    }

    function modifyEmail($mysqli, $email){
        $stmt = $mysqli->prepare("UPDATE usuarios SET email = ? WHERE nombre = ?");
        $stmt->bind_param("ss", $email, $_SESSION['nickUsuario']);
        $stmt->execute();
        $stmt->close();
    }

    function modifyPass($mysqli, $pass){
        $stmt = $mysqli->prepare("UPDATE usuarios SET pass = ? WHERE nombre = ?");
        $stmt->bind_param("ss", password_hash($pass, PASSWORD_DEFAULT), $_SESSION['nickUsuario']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarNombreEvento($mysqli, $nombre){
        $stmt = $mysqli->prepare("UPDATE eventos SET nombre = ? WHERE id = ?");
        $stmt->bind_param("si", $nombre, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarLugar($mysqli, $lugar){
        $stmt = $mysqli->prepare("UPDATE eventos SET lugar = ? WHERE id = ?");
        $stmt->bind_param("si", $lugar, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarFecha($mysqli, $fecha){
        $stmt = $mysqli->prepare("UPDATE eventos SET fecha = ? WHERE id = ?");
        $stmt->bind_param("si", $fecha, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarDescripcion($mysqli, $descripcion){
        $stmt = $mysqli->prepare("UPDATE eventos SET descripcion = ? WHERE id = ?");
        $stmt->bind_param("si", $descripcion, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarWeb($mysqli, $web){
        $stmt = $mysqli->prepare("UPDATE eventos SET web = ? WHERE id = ?");
        $stmt->bind_param("si", $web, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarFacebook($mysqli, $facebook){
        $stmt = $mysqli->prepare("UPDATE eventos SET facebook = ? WHERE id = ?");
        $stmt->bind_param("si", $facebook, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }
    
    function cambiarTwitter($mysqli, $twitter){
        $stmt = $mysqli->prepare("UPDATE eventos SET twitter = ? WHERE id = ?");
        $stmt->bind_param("si", $twitter, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarImagenPrincipal($mysqli, $img){
        $stmt = $mysqli->prepare("UPDATE eventos SET imagen = ? WHERE id = ?");
        $stmt->bind_param("si", $img, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarImg1($mysqli, $img){
        $stmt = $mysqli->prepare("UPDATE eventos SET img_galeria1 = ? WHERE id = ?");
        $stmt->bind_param("si", $img, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarImg2($mysqli, $img){
        $stmt = $mysqli->prepare("UPDATE eventos SET img_galeria2 = ? WHERE id = ?");
        $stmt->bind_param("si", $img, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarImg3($mysqli, $img){
        $stmt = $mysqli->prepare("UPDATE eventos SET img_galeria3 = ? WHERE id = ?");
        $stmt->bind_param("si", $img, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarEtiqueta1($mysqli, $etiq){
        $stmt = $mysqli->prepare("UPDATE eventos SET etiqueta1 = ? WHERE id = ?");
        $stmt->bind_param("si", $etiq, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarEtiqueta2($mysqli, $etiq){
        $stmt = $mysqli->prepare("UPDATE eventos SET etiqueta2 = ? WHERE id = ?");
        $stmt->bind_param("si", $etiq, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function cambiarEtiqueta3($mysqli, $etiq){
        $stmt = $mysqli->prepare("UPDATE eventos SET etiqueta3 = ? WHERE id = ?");
        $stmt->bind_param("si", $etiq, $_SESSION['Evento']);
        $stmt->execute();
        $stmt->close();
    }

    function listaEventos($mysqli){
        $res = $mysqli->query("SELECT nombre FROM eventos");
        
        while ($fila = $res->fetch_row()){
            $eventos[] = $fila[0];
        }

        $res->close();

        $linea = "<div id=\"lista\">";

        foreach ($eventos as $e){
            $linea .= $e;
            $linea .= "\n";
        }

        $linea .= "</div>";
        
        return $linea;
    }

    function listaComentarios ($mysqli, $idEv){
        $stmt = $mysqli->prepare("SELECT id, autor, texto, fecha, hora, editado FROM comentarios WHERE evento = ?");
        $stmt->bind_param("i", $idEv);
        $stmt->execute();

        $res = $stmt->get_result();

        $linea = "<div id=\"comments\">";

        while ($fila = $res->fetch_row()){
            $linea .= $fila[0] . "\t";
            $linea .= $fila[1] . "\t";
            $linea .= $fila[2] . "\t";
            $linea .= $fila[3] . "\t";
            $linea .= $fila[4] . "\t";
            $linea .= $fila[5];
            $linea .= "\n";
        }

        $linea .= "</div>";
        $res->close();
        
        return $linea;
    }

    function addComentario ($mysqli, $comentario, $idEv){
        if ($comentario != ""){
            $user = $_SESSION['nickUsuario'];
            $stmt1 = $mysqli->prepare("SELECT email FROM usuarios WHERE nombre = ?");
            $stmt1->bind_param("s", $user);
            $stmt1->execute();
            
            $res = $stmt1->get_result();
            $fila = $res->fetch_row();
            $email = $fila[0];
            $fecha = date("d/m/Y");
            $hora = date("H:i");

            $stmt2 = $mysqli->prepare("INSERT INTO comentarios (autor, email, texto, fecha, hora, evento, editado) VALUES (?, ?, ?, ?, ?, ?, false)");
            $stmt2->bind_param("sssssi", $user, $email, $comentario, $fecha, $hora, $idEv);
            $stmt2->execute();

            $stmt1->close();
            $stmt2->close();
        }
    }

    function AddEvento ($mysqli, $nombre, $lugar, $fecha, $descripcion, $web, $facebook, $twitter){
        $stmt = $mysqli->prepare("INSERT INTO eventos (nombre, lugar, fecha, descripcion, web, twitter, facebook, publicado) VALUES (?, ?, ?, ?, ?, ?, ?, false)");
        $stmt->bind_param("sssssss", $nombre, $lugar, $fecha, $descripcion, $web, $facebook, $twitter);
        $stmt->execute();
    }

    function comprobarRol ($mysqli, $user){
        $stmt = $mysqli->prepare("SELECT registrado, moderador, gestor, super FROM usuarios WHERE nombre = ?");
        $stmt->bind_param("s", $user);
        $stmt->execute();

        $res = $stmt->get_result();

        while ($fila = $res->fetch_row()){
            if ($fila[0]){
                $rol = 1;
            }
            else if ($fila[1]){
                $rol = 2;
            }
            else if ($fila[2]){
                $rol = 3;
            }
            else if ($fila[3]){
                $rol = 4;
            }
        }

        return $rol;
    }

    function getComentarios ($mysqli){
        $stmt = $mysqli->prepare("SELECT id, autor, texto, fecha, hora, evento, editado FROM comentarios");
        $stmt->execute();

        $res = $stmt->get_result();

        $linea = "<div id=\"comments\">";

        while ($fila = $res->fetch_row()){
            $linea .= $fila[1] . "\t";
            $linea .= $fila[2] . "\t";
            $linea .= $fila[3] . "\t";
            $linea .= $fila[4] . "\t";
            $linea .= $fila[5] . "\t";
            $linea .= $fila[0] . "\t";
            $linea .= $fila[6];
            $linea .= "\n";
        }

        $linea .= "</div>";
        $res->close();
        
        return $linea;
    }

    function getEventos ($mysqli) {
        $stmt = $mysqli->prepare("SELECT id, nombre FROM eventos");
        $stmt->execute();

        $res = $stmt->get_result();

        $linea = "<div id=\"lista\">";

        while ($fila = $res->fetch_row()){
            $linea .= $fila[0] . "\t";
            $linea .= $fila[1];
            $linea .= "\n";
        }

        $linea .= "</div>";
        $res->close();
        
        return $linea;
    }

    function getUsuarios ($mysqli) {
        $stmt = $mysqli->prepare("SELECT nombre FROM usuarios");
        $stmt->execute();

        $res = $stmt->get_result();

        $linea = "<div id=\"usuarios\">";

        while ($fila = $res->fetch_row()){
            $linea .= $fila[0];
            $linea .= "\n";
        }

        $linea .= "</div>";
        $res->close();
        
        return $linea;
    }

    function eliminarComentario ($mysqli, $id){
        $stmt = $mysqli->prepare("DELETE FROM comentarios WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }

    function eliminarEvento ($mysqli, $id){
        $stmt = $mysqli->prepare("DELETE FROM eventos WHERE id = ?");
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }

    function editarComentario ($mysqli, $texto, $id){
        $stmt = $mysqli->prepare("UPDATE comentarios SET texto = ? WHERE id = ?");
        $stmt->bind_param("si", $texto, $id);
        $stmt->execute();
        $stmt->close();

        $stmt2 = $mysqli->prepare("UPDATE comentarios SET editado = true WHERE id = ?");
        $stmt2->bind_param("i", $id);
        $stmt2->execute();
        $stmt2->close();
    }

    function comprobarSuper($mysqli, $usuario){
        $stmt = $mysqli->prepare("SELECT nombre FROM usuarios WHERE super = true");
        $stmt->execute();

        $res = $stmt->get_result();

        while ($fila = $res->fetch_row()){
            if ($usuario === $fila[0])
                return true;
        }

        $stmt->close();

        return false;
    }

    function countSuper($mysqli){
        $stmt = $mysqli->prepare("SELECT nombre FROM usuarios WHERE super = true");
        $stmt->execute();

        $res = $stmt->get_result();

        $count = 0;

        while ($fila = $res->fetch_row()){
            $count++;
        }

        $stmt->close();

        return $count;
    }

    function cambiarPermisos ($mysqli, $usuario, $permisos){
        if(countSuper($mysqli)>1 || !comprobarSuper($mysqli, $usuario)){
            if ($permisos === "1" || $permisos === "2" || $permisos === "3" || $permisos === "4"){
                $stmt = $mysqli->prepare("UPDATE usuarios SET registrado = false, moderador = false, gestor = false, super = false WHERE nombre = ?");
                $stmt->bind_param("s", $usuario);
                $stmt->execute();
                $stmt->close();

                if ($permisos === "1") {   
                    $stmt2 = $mysqli->prepare("UPDATE usuarios SET registrado = true WHERE nombre = ?");
                    $stmt2->bind_param("s", $usuario);
                    $stmt2->execute();
                    $stmt2->close();
                }
                else if ($permisos === "2"){
                    $stmt2 = $mysqli->prepare("UPDATE usuarios SET moderador = true WHERE nombre = ?");
                    $stmt2->bind_param("s", $usuario);
                    $stmt2->execute();
                    $stmt2->close();
                }
                else if ($permisos === "3"){
                    $stmt2 = $mysqli->prepare("UPDATE usuarios SET gestor = true WHERE nombre = ?");
                    $stmt2->bind_param("s", $usuario);
                    $stmt2->execute();
                    $stmt2->close();
                }
                else if ($permisos === "4"){
                    $stmt2 = $mysqli->prepare("UPDATE usuarios SET super = true WHERE nombre = ?");
                    $stmt2->bind_param("s", $usuario);
                    $stmt2->execute();
                    $stmt2->close();
                }
            }
        }
    }

    function buscarEventoGestor ($mysqli, $etiq){
        $stmt = $mysqli->prepare("SELECT id, nombre FROM eventos WHERE descripcion LIKE ? OR nombre LIKE ? OR etiqueta1 LIKE ? OR etiqueta2 LIKE ? OR etiqueta3 LIKE ?");
        $stmt->bind_param("sssss", $etiq, $etiq, $etiq, $etiq, $etiq);
        $stmt->execute();

        $res = $stmt->get_result();

        $lista = array();

        while ($fila = $res->fetch_row()){
            array_push($lista, ['id'=>$fila[0], 'nombre'=>$fila[1]]);
        }

        $res->close();

        $stmt->close();

        return $lista;
    }

    function buscarEvento ($mysqli, $etiq){
        $stmt = $mysqli->prepare("SELECT id, nombre FROM eventos WHERE (descripcion LIKE ? OR nombre LIKE ? OR etiqueta1 LIKE ? OR etiqueta2 LIKE ? OR etiqueta3 LIKE ?) AND publicado = true");
        $stmt->bind_param("sssss", $etiq, $etiq, $etiq, $etiq, $etiq);
        $stmt->execute();

        $res = $stmt->get_result();

        $lista = array();

        while ($fila = $res->fetch_row()){
            array_push($lista, ['id'=>$fila[0], 'nombre'=>$fila[1]]);
        }

        $res->close();

        $stmt->close();

        return $lista;
    }
?>