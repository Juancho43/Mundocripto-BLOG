<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/PostController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}
if(isset($_POST["create"])){
    $post = new PostController($link);
    $title = $_POST["title"];
    $cantidad = intval($_POST["cantidadParrafos"]);
    $parrafos = array();
    for($i=1;$i<=$cantidad;$i++){
        $parrafos[]=$_POST["parrafo$i"];   
    }

    $postId = $post->createPost($title);
    $post->createParagraph($postId,$parrafos);
    if(!empty($_POST["publicar"])){
        $post->publishPost($postId);
    }
    header("Location: feed.php");
}
?>


