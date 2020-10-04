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
    }
    else if (isset($_SESSION['error'])) {
      $variablesParaTwig['error'] = "Este nombre de usuario ya existe, escoge otro";
    } 
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $nick = $_POST['nick'];
      $email = $_POST['email'];
      $pass = $_POST['pass'];
      
      if (checkRegistry($mysqli, $nick, $email, $pass)) {
        session_start();
      
        $_SESSION['nickUsuario'] = $nick;  // guardo en la sesión el nick del usuario que se ha logueado
        $_SESSION['error'] = "";
        $_SESSION['rol'] = 1;
      }
      else{
        $_SESSION['error'] = "Este nombre de usuario ya existe, escoge otro";
      }

      header ("Location: registro.php");

      exit();
  }

    $mysqli->close();
    
    echo $twig->render('registro.html', $variablesParaTwig);
?>