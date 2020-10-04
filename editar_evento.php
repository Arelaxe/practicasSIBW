<?php
   require_once "/usr/local/lib/php/vendor/autoload.php";
   require_once "bd.php";
   
   $loader = new \Twig\Loader\FilesystemLoader('templates');
   $twig = new \Twig\Environment($loader);
    
   session_start();
   $mysqli = conexionDB();

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nombre'])) {
            $nombre = $_POST['nombre'];
            cambiarNombreEvento($mysqli, $nombre);
        }

        if (isset($_POST['lugar'])) {
            $lugar = $_POST['lugar'];
            cambiarLugar($mysqli, $lugar);
        }

        if (isset($_POST['fecha'])) {
            $fecha = $_POST['fecha'];
            cambiarFecha($mysqli, $fecha);
        }

        if (isset($_POST['descripcion'])) {
            $descripcion = $_POST['descripcion'];
            cambiarDescripcion($mysqli, $descripcion);
        }

        if (isset($_POST['web'])) {
            $web = $_POST['web'];
            cambiarWeb($mysqli, $web);
        }

        if (isset($_POST['facebook'])) {
            $facebook = $_POST['facebook'];
            cambiarFacebook($mysqli, $facebook);
        }

        if (isset($_POST['twitter'])) {
            $twitter = $_POST['twitter'];
            cambiarTwitter($mysqli, $twitter);
        }

        if(isset($_FILES['imagen'])){
            $errors= array();
            $file_name = $_FILES['imagen']['name'];
            $file_size = $_FILES['imagen']['size'];
            $file_tmp = $_FILES['imagen']['tmp_name'];
            $file_type = $_FILES['imagen']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['imagen']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext,$extensions) === false){
              $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
              $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
              move_uploaded_file($file_tmp, "img/" . $file_name);
              
              $img = "img/" . $file_name;
              cambiarImagenPrincipal($mysqli, $img);
            }
            
            if (sizeof($errors) > 0) {
              $varsParaTwig['errores'] = $errors;
            }
        }

        if(isset($_FILES['img1'])){
            $errors= array();
            $file_name = $_FILES['img1']['name'];
            $file_size = $_FILES['img1']['size'];
            $file_tmp = $_FILES['img1']['tmp_name'];
            $file_type = $_FILES['img1']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['img1']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext,$extensions) === false){
              $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
              $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
              move_uploaded_file($file_tmp, "img/" . $file_name);
              
              $img = "img/" . $file_name;
              cambiarImg1($mysqli, $img);
            }
            
            if (sizeof($errors) > 0) {
              $varsParaTwig['errores'] = $errors;
            }
        }

        if(isset($_FILES['img2'])){
            $errors= array();
            $file_name = $_FILES['img2']['name'];
            $file_size = $_FILES['img2']['size'];
            $file_tmp = $_FILES['img2']['tmp_name'];
            $file_type = $_FILES['img2']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['img2']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext,$extensions) === false){
              $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
              $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
              move_uploaded_file($file_tmp, "img/" . $file_name);
              
              $img = "img/" . $file_name;
              cambiarImg2($mysqli, $img);
            }
            
            if (sizeof($errors) > 0) {
              $varsParaTwig['errores'] = $errors;
            }
        }

        if(isset($_FILES['img3'])){
            $errors= array();
            $file_name = $_FILES['img3']['name'];
            $file_size = $_FILES['img3']['size'];
            $file_tmp = $_FILES['img3']['tmp_name'];
            $file_type = $_FILES['img3']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['img3']['name'])));
            
            $extensions= array("jpeg","jpg","png");
            
            if (in_array($file_ext,$extensions) === false){
              $errors[] = "Extensión no permitida, elige una imagen JPEG o PNG.";
            }
            
            if ($file_size > 2097152){
              $errors[] = 'Tamaño del fichero demasiado grande';
            }
            
            if (empty($errors)==true) {
              move_uploaded_file($file_tmp, "img/" . $file_name);
              
              $img = "img/" . $file_name;
              cambiarImg3($mysqli, $img);
            }
            
            if (sizeof($errors) > 0) {
              $varsParaTwig['errores'] = $errors;
            }
        }

        if (isset($_POST['etiqueta1'])) {
            $etiq = $_POST['etiqueta1'];
            cambiarEtiqueta1($mysqli, $etiq);
        }

        if (isset($_POST['etiqueta2'])) {
            $etiq = $_POST['etiqueta2'];
            cambiarEtiqueta2($mysqli, $etiq);
        }

        if (isset($_POST['etiqueta3'])) {
            $etiq = $_POST['etiqueta3'];
            cambiarEtiqueta3($mysqli, $etiq);
        }

       header ("Location: lista_eventos.php");

       exit();
   }

   $mysqli->close();


    echo $twig->render('editar_evento.html',[]);
?>