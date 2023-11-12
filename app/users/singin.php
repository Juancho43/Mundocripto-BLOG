<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");

if(isset($_POST["singin"])){
    $user = new UserController($link);
    $hash = password_hash($_POST["password"],PASSWORD_ARGON2I);
    if($user->singin($_POST["nickname"],$_POST["mail"],$hash)){
        $user->login($_POST["mail"],$_POST["password"]);
        header("Location: ../../");
    }else{
        header("Location: registrarse.php");
    }
    
    
}
?>


