<?php
   require_once "/usr/local/lib/php/vendor/autoload.php";
   require_once "bd.php";
   
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);
    
   session_start();

   $mysqli = conexionDB();

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['email'])) {
            $email = $_POST['email'];
            modifyEmail($mysqli, $email);
        }

        if (isset($_POST['pass'])) {
            $pass = $_POST['pass'];
            modifyPass($mysqli, $pass);
        }


       header ("Location: modify.php");

       exit();
   }

   $mysqli->close();

    echo $twig->render('modify.html',[]);
?>
