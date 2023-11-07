<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("PostController.php");


$posts = new PostController($link);
$data = $posts->showOwnPost(0,10);


?>
<link rel="stylesheet" href="../assets/css/feed.css">

<main>
      <section class="Post--nuevo">
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/nuevo-post.php'">Crear publicación.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/feed.php'">Ver feed.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/ver-comentarios.php'">Ver comentarios.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/users/profile.php'">Ver perfil.</a>
    </section>
    <div class="Posts">
        
   
<?php

if($_SESSION["online"]){
    ?>

  
    
    <?php
}

for($c = 0; $c < count($data);$c++){
    ?>
    <section class="Post">
        <h3 class="Post--title"><?=$data[$c]["title"]?></h3>
        <h4 class="Post--author"><?=$data[$c]["nickname"]?></h4>
        <h4 class="Post--author"><?php if($data[$c]["publish"]== 1){
            echo "Publicado";
        }else{
            echo "Borrador";
        }
        ?>  
        <h4 class="Post--author"></h4>
        <p class="Post--paragraph"><?=$data[$c]["paragraph"]?></p>
    </section>
    
    <?php
    
}

?>
     </div>
</main>

<?php 

require_once("../templates/footer.php");
?>