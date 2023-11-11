<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>
<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form method="post" action ="singin.php">
        <p class="msg">
            <?=$_SESSION["msg"]?>
        </p>
        <legend>Registrarse</legend>
        <fieldset class="Form--part">
            <input type="text" name="nickname" id="nickname" placeholder="Nickname" require>
            <input type="text" name="mail" id="mail" placeholder="Correo Electronico" require>
            <input type="password" name="password" id="password" placeholder="Contraseña" require>
        </fieldset>
        <input type="submit" value="Registrarse" name="singin">    
    </form>
</main>

<?php
    require_once("../templates/footer.php");
?>