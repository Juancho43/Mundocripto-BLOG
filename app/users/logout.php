<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require("../controllers/UserController.php");
$user = new UserController($link);
$user->logout();
header("Location: ../../");

?>


