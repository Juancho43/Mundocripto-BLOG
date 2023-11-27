<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}

    $user = new UserController($link);
    $id = intval($_SESSION["iduser"]);
    $user->deleteUser($id);
    $user->logout();
    header("Location: ../feed/feed.php");

?>


