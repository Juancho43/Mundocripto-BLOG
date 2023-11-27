<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
if(!$_SESSION["online"]){
    header("Location: ../../");
}
?>

<link rel="stylesheet" href="../assets/css/formulario.css">
<main>
    <form class="UserForm" method="post" action ="changeNickname.php">
        <?php
            if(isset($_SESSION["msg"]))
            {
                echo "<p class='Profile--msg' id='msg' title='Haga click para cerrar.'>".$_SESSION["msg"]."<p>";
            }
        ?>
        <legend>Cambiar nickname</legend>
        <fieldset class="Form--part">
                <input type="text" placeholder="Ingrese su nuevo nickname." name="nickname" id="nickname"  required>
                <input class="Form--submit" type="submit" value="Cambiar" name="changeNickname">    
        </fieldset>
        <fieldset class="Form--options">
            <a href='profile.php'>Volver</a>
            
        </fieldset>
    </form>        
</main>

<?php
    require_once("../templates/footer.php");
?>