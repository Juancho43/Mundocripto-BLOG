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
            <?php
                if (isset($_SESSION["msg"])) {
                    echo"<p>".$_SESSION["msg"]."</p>";
                }
            ?>
        </p>
        <legend>Registrarse</legend>

        <fieldset class="Form--part">
            <input type="text" name="nickname" id="nickname" placeholder="Nickname" require>
            <input type="text" name="mail" id="mail" placeholder="Correo Electronico" require>
            <input type="password" min="4" name="password" id="password1" placeholder="Contraseña" require>
            <input type="password" min="4" placeholder="Repita la contraseña" onkeyup="verifyPasswords()" id="password2" required>
        </fieldset>
        <input type="submit" value="Registrarse" name="singin" disabled>    
    </form>
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
</main>

<?php
    require_once("../templates/footer.php");
?>