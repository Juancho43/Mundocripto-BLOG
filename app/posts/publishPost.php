<?php
session_start();
if(!$_SESSION["online"]){
    header("Location: ../../");
}
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/PostController.php");

if(!$_SESSION["online"]){
    header("Location: feed.php");
}

$post = new PostController($link);
$idPost = $_GET["id"];
$post->publishPost($idPost);
header("Location: ../feed/ver-posts.php");


?>


