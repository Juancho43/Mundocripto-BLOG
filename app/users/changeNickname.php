<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}
if(isset($_POST["changeNickname"]))
{
    $go = "";
    $user = new UserController($link);
    $newNickname = $_POST["nickname"];
    $ok = $user->alreadyExist($newNickname, "nickname");

    if($ok === false)
    {
        $user->changeNickname($newNickname);
        $user->recordChange($_SESSION["iduser"],$_SESSION["iduser"],"changeNickname","user");
        $_SESSION["msg"] = "Nuevo nickname establecido.";
        $go = "profile.php";
    }else{
        $_SESSION["msg"] = "Tu nickname debe ser único";
        $go = "cambiar-nickname.php";
    }
    
    
 
    header("Location: $go");
} 
?>


