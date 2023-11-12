<?php
session_start();
if(!$_SESSION["online"]){
    header("Location: ../../");
}
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");
$user = new UserController($link);
$user->logout();
header("Location: ../../");

?>


