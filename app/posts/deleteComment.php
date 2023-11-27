<?php
session_start();
if(!$_SESSION["online"]){
    header("Location: ../../");
}
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/CommentController.php");

if(!$_SESSION["online"]){
    header("Location: feed.php");
}

$comment = new CommentController($link);
$idComment = $_GET["id"];

if(isset($_GET["idPost"])){
    $idPost = $_GET["idPost"];
    if($comment->deleteComment($idComment)){
        header("Location: ver-post.php?id=$idPost");
    }
}elseif(isset($_GET["go"])){
    if($comment->deleteComment($idComment)){
        header("Location: ver-comentarios.php");
    }
}



?>


