<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");


if(isset($_POST["login"])){
    $user = new UserController($link);
    
    if($user->login($_POST["mail"],$_POST["password"])){
        header("Location: ../../");
    }else{
        header("Location: ../users/iniciar-sesion.php");
    }
     
    
}
?>


