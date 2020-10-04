<?php
   require_once "/usr/local/lib/php/vendor/autoload.php";
   require_once "bd.php";
   
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);

   $mysqli = conexionDB();

   session_start();

   $variablesParaTwig = [];

    if (isset($_SESSION['nickUsuario'])) {
      $variablesParaTwig['user'] = $_SESSION['nickUsuario'];
      $variablesParaTwig['error'] = "";
    }
    else if (isset($_SESSION['error'])) {
      $variablesParaTwig['error'] = $_SESSION['error'];
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nick = $_POST['nick'];
        $pass = $_POST['pass'];
      
        if (checkLogin($mysqli, $nick, $pass)) {
          session_start();
          
          $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
          $_SESSION['rol'] = comprobarRol($mysqli,$nick);
        }
        else{
            $_SESSION['error'] = "Credenciales incorrectos";
        }
        
        header("Location: iniciar_sesion.php");

        exit();
    }

    $mysqli->close();
    
    echo $twig->render('iniciar_sesion.html', $variablesParaTwig);
?>