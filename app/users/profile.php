<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/UserController.php");


$user = new UserController($link);
$userData = $user->showUser($_SESSION["email"]);


?>
<link rel="stylesheet" href="../assets/css/profile.css">
<main class="Ver--Profile">

    <section class="Profile">
        <h2>Perfil</h2>
        <article>
            
            <p>Nickname: <?=$userData[0]["nickname"]?></p>
            <p>Creado: <?=$userData[0]["date"]?></p>
            <p>Email: <?=$_SESSION["email"]?></p>
            <p><a href="recuperar.php">Cambiar contraseña.</a></p>
            <p>Último cambio de contraseña: </p>
            <p>Último cambio de nickname: </p>
        </article>
    </section>

</main>

<?php 

require_once("../templates/footer.php");
?>
