<?php
$url = get_url();
?>
<header>
    <h1><a onclick="window.location.href = 'http://<?=$url?>/edi2/'">Mundo cripto</a></h1>
    <?php
     if($_SESSION["online"])
        {
            ?>
                <ul>
                    <li><a id="btn-salir">Cerrar sesión</a></li>
                </ul>
            <?php
        }else
        {
            ?>
                <ul>
                    <li><a onclick="window.location.href = 'http://<?=$url?>/edi2/app/users/iniciar-sesion.php'">Iniciar sesión</a></li>
                    <li><a onclick="window.location.href = 'http://<?=$url?>/edi2/app/users/registrarse.php'">Registrarse</a></li>
                </ul>
            <?php
        }
    ?>
</header>

<script>
   var elemento = document.getElementById("btn-salir");
    elemento.addEventListener("click", function(){
        if (window.confirm("¿Quieres cerrar sesión?")) {
            window.location.href="http://<?=$url?>/edi2/app/users/logout.php";
        }
    
    });
</script>