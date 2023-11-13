<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/PostController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}
if(isset($_POST["editPost"])){
    $post = new PostController($link);
    $newTitle = $_POST["title"];

    $cantidad = intval($_POST["cantidadParrafos"]);
    $parrafos = array();
    for($i=1;$i<=$cantidad;$i++){
        $parrafos[]=$_POST["parrafo$i"];   
    }
    
    // $postId = $post->editPost($idPost,$newTitle);
    //pensar para editar parrafos antiguos.

    
    header("Location: ver-posts.php");
}
?>


