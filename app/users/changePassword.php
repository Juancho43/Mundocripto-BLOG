<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("UserController.php");

if(isset($_POST["changePassword"]))
{
    $user = new UserController($link);
    $newPassword = password_hash($_POST["password"],PASSWORD_ARGON2I);
    $user->changePassword($newPassword);
 
    header("Location: profile.php");
} 
?>

