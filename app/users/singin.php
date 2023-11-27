<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");

if(isset($_POST["singin"])){
    $user = new UserController($link);
    $mail = $_POST["mail"];
    $nickname = $_POST["nickname"];
    $mailOK = $user->alreadyExist($mail,"email");
    $nicknameOK = $user->alreadyExist($nickname,"nickname");
    $ok = false;
    $go = "";
    var_dump($mailOK);
    var_dump($nicknameOK);
    if(!$mailOK and !$nicknameOK)
    {
        $hash = password_hash($_POST["password"],PASSWORD_ARGON2I);
        $idUser = $user->singin($_POST["nickname"],$_POST["mail"],$hash);
        
            $user->recordChange($idUser,$idUser,"new","user");
            $user->login($_POST["mail"],$_POST["password"]);
            $_SESSION["msg"] = "Usuario creado correctamente.";
            $go = "../../";
        
    }else{
        $_SESSION["msg"] = "Datos invalidos";
        $go = "registrarse.php";
    }
    header("Location: $go");
}
?>


