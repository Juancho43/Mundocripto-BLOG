<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>
<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form method="post" action ="../users/singin.php">
        <legend>Registrarse</legend>
        <fieldset class="Main">
            <input type="text" name="nickname" id="nickname" placeholder="Nickname">
            <input type="text" name="mail" id="mail" placeholder="Correo Electronico">
            <input type="password" name="password" id="password" placeholder="Contraseña">
            
            <input type="submit" value="Iniciar sesión" name="singin">    
        </fieldset>
    </form>
</main>

<?php
    require_once("../templates/footer.php");
?>