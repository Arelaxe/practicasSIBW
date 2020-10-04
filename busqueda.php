<?php
    require_once "/usr/local/lib/php/vendor/autoload.php";
    require_once "bd.php";

    session_start();

    header('Content-Type: application/json');
    $mysqli = conexionDB();

    $texto = "%{$_POST['busqueda']}%";

    if(!empty($texto)){
        if($_SESSION['rol']>2){
            $datos = buscarEventoGestor($mysqli, $texto);
        }
        else{
            $datos = buscarEvento($mysqli, $texto);
        }
    }

    echo (json_encode($datos));
    $mysqli->close();
?>