<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("UserController.php");

if(isset($_POST["singin"])){
    $user = new UserController($link);
    $user->singin($_POST["nickname"],$_POST["mail"],$_POST["password"]);
    header("Location: ../../");
}
?>


