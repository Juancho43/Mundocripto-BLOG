<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>
<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form method="post" action ="../users/login.php">
        <p class="msg">
            <?=$_SESSION["msg"]?>
        </p>
        <legend>Iniciar sesión</legend>
        <fieldset class="Main">
            <input type="text" name="mail" id="mail" placeholder="Correo Electronico">
            <div class="contrasenia">
                <input type="password" name="password" id="password" placeholder="Contraseña">
            </div>
            <input type="submit" value="Iniciar sesión" name="login">    
        </fieldset>
        <fieldset class="Opciones">
            <a href='formulario-recuperar.php'>¿Olvidaste tu contraseña?</a>
        </fieldset>
        
    
    </form>
        
    </main>

<?php
    require_once("../templates/footer.php");
?>