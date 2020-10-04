<?php
  require_once "bd.php";
  $mysqli = conexionDB();

  eliminarComentario($mysqli,$_GET['id']);
  
  header("Location: lista_comentarios.php");

  $mysqli->close();

  exit();

?>