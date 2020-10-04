<?php
  require_once "bd.php";
  $mysqli = conexionDB();

  eliminarEvento($mysqli,$_GET['id']);
  
  header("Location: lista_eventos.php");

  $mysqli->close();

  exit();

?>