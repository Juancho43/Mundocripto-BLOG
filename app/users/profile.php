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
        <?php
            if(isset($_SESSION["msg"]))
            {
                echo "<p class='Profile--msg' id='btn-cerrar' title='Haga click para cerrar.'>".$_SESSION["msg"]."<p>";
            }

        ?>
        <h2>Perfil</h2>
        <article class="Profile--info">
            <p>Nickname: <?=$userData[0]["nickname"]?></p>
            <p>Email: <?=$_SESSION["email"]?></p>
        </article>
        <h3>Información</h3>
        <article class="Profile--changes">
            <p>Creado: <?=formatearFecha($userData[0]["date"])?></p>
        </article>
        <h3>Acciones</h3>
        <article class="Profile--actions">
            <p><a href="cambiar-nickname.php">Cambiar nickname.</a></p>
            <p><a href="cambiar-contrasenia.php">Cambiar contraseña.</a></p>
            <p><a id="btn-eliminar">Eliminar cuenta.</a></p>
        </article>
        <script>
            var elemento = document.getElementById("btn-cerrar");
            elemento.addEventListener("click", function(event){
                event.target.parentNode.removeChild(event.target);
            
            });

            var elemento2 = document.getElementById("btn-eliminar");
            elemento2.addEventListener("click", function(){
                if (window.confirm("¿Quieres eliminar tu cuenta y toda la Información asociada?")) {
                    window.location.href="http://<?=$url?>/app/users/deleteUser.php";
                }
            
            });

        </script>
    </section>

</main>

<?php 

require_once("../templates/footer.php");
?>
