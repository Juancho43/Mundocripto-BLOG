<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/UserController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}

$user = new UserController($link);
$userData = $user->showUser($_SESSION["email"]);


?>
<link rel="stylesheet" href="../assets/css/profile.css">
<main class="Ver--Profile">

    <section class="Profile">
        <h2>Perfil</h2>
        <article class="Profile--info">
            <p>Nickname: <?=$userData[0]["nickname"]?></p>
            <p>Email: <?=$_SESSION["email"]?></p>
        </article>
        <article class="Profile--changes">
            <p>Creado: <?=formatearFecha($userData[0]["date"])?></p>
            <p>Cambio de nickname: </p>
            <p>Cambio de contraseña: </p>
        </article>
        <article class="Profile--actions">
            <p><a href="recuperar.php">Cambiar contraseña.</a></p>
        </article>
    </section>

</main>

<?php 

require_once("../templates/footer.php");
?>
