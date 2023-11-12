<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/CommentController.php");
require("../controllers/UserController.php");


if(isset($_POST["newComment"])){
    $comment = new CommentController($link);
    $id = $comment->publishComment($_POST["idpost"],$_POST["comment"]);
    $user = new UserController($link);
    $user->recordChange($_SESSION["iduser"],$id,"new","comment");
    header("Location: ../feed/ver-post.php?id=".$_POST['idpost']."");
}
?>


