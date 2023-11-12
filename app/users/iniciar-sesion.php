<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>
<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form class="UserForm" method="post" action ="login.php">
        <p class="msg">
            <?=$_SESSION["msg"]?>
        </p>
        <legend>Iniciar sesión</legend>
        <fieldset class="Form--part">
            <input type="text" name="mail" id="mail" placeholder="Correo Electronico">
            <div class="contrasenia">
                <input type="password" name="password" id="password" placeholder="Contraseña">
            </div>
            <input class="Form--submit" type="submit" value="Iniciar sesión" name="login">    
        </fieldset>
        <fieldset class="Form--options">
            <p><a href='registrarse.php'>¿No tiene una cuenta?</a></p>
        </fieldset>
    </form>        
</main>

<?php
    require_once("../templates/footer.php");
?>