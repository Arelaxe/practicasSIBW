<?php
  require_once "/usr/local/lib/php/vendor/autoload.php";
  require_once "bd.php";
 
  $loader = new \Twig\Loader\FilesystemLoader('templates');
  $twig = new \Twig\Environment($loader);

  session_start();
  $mysqli = conexionDB();

  $variablesParaTwig['id'] = $_GET['id'];

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['comentario'])) {
      global $var;
      $comment = $_POST['comentario'];
      $id = $_POST['id'];
      editarComentario($mysqli, $comment, $id);
    }
  
    header("Location: lista_comentarios.php");

    exit();

  }

  $mysqli->close();

  echo $twig->render('editar_comentario.html', $variablesParaTwig);
?>