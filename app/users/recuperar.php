<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>
<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form class="UserForm" method="post" action ="changePassword.php">
        <legend>Cambiar contraseña</legend>
        <fieldset class="Form--part">
                <input type="text" min="4" placeholder="Ingrese su nueva contraseña." name="password" id="password1"  required>
                <input type="text" min="4" placeholder="Ingresela nuevamente." onkeyup="verifyPasswords()" id="password2" required>
                <input class="Form--submit" type="submit" value="Iniciar sesión" name="changePassword" disabled>    
        </fieldset>
        <fieldset class="Form--options">
            <a href='profile.php'>Volver</a>
            
        </fieldset>
    </form>        
</main>
<script>
    
    function verifyPasswords() {
        const password1 = document.getElementById('password1');
        const password2 = document.getElementById('password2');
        const submitButton = document.querySelector('input[type="submit"]');
        if (password1.value !== password2.value) 
        {
            submitButton.disabled = true;   
        }else{
            submitButton.disabled = false;
        }
    }

    
</script>
<?php
    require_once("../templates/footer.php");
?>