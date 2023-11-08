<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("PostController.php");


$post = new PostController($link);
$postData = $post->showPost($_GET["id"]);
//$comments = 
$paragraphs = $post->showParagraps($postData[0]["idpost"]);
?>
<link rel="stylesheet" href="../assets/css/feed.css">
<main class="Ver--posts">

    <section class="Post">
        <h3><?=$postData[0]["title"]?></h3>
        <h4>Creado: <?=$postData[0]["date"]?></h4>
        <section class="Post--paragraphs">
            <?php
                for($i=0;$i<count($paragraphs);$i++){
                    echo "<p class='Post--paragraph'>".$paragraphs[$i]["paragraph"]."</p>";
                }
            ?>
        </section>
       
        
        

        
        <?php
        ?>
    </section>
    <section class="Comments">
        <h3>Comentarios:</h3>
            <?php
                for($i=0;$i<count($paragraphs);$i++){
                    echo "<p class='Post--paragraph'>".$paragraphs[$i]["paragraph"]."</p>";
                }
            ?>
    </section>


</main>

<?php 

require_once("../templates/footer.php");
?>
