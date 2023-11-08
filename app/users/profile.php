<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("UserController.php");


$user = new UserController($link);
$userData = $user->showUser($_SESSION["email"]);


?>
<link rel="stylesheet" href="../assets/css/profile.css">
<main class="Ver--Profile">

    <section class="Profile">
        <h3><?=$userData[0]["nickname"]?></h3>
        <p>Creado: <?=$userData[0]["date"]?></p>
        <p>Email: <?=$_SESSION["email"]?></p>

        <p>¿Cambiar contraseña?</p>
        <?php
        ?>
    </section>


</main>

<?php 

require_once("../templates/footer.php");
?>
