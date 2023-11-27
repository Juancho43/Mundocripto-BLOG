<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/CommentController.php");


if(!$_SESSION["online"]){
    header("Location: ../../");
}
$comment = new CommentController($link);
$comments = $comment->getComments($_SESSION["iduser"]);
?>
<link rel="stylesheet" href="../assets/css/feed.css">
<link rel="stylesheet" href="../assets/css/post.css">
<main class="Ver--comentarios">
    <div class="Comments">

    
        <?php
            for($c = 0; $c < count($comments);$c++){
        ?>
            <article class="Comment">
                <p class="Comment--info">
                    <?=formatearFecha($comments[$c]["date"]);?>
                </p>
                <p class="Comment--body">
                    <?=$comments[$c]["comment"]?>
                </p>
                <a href="ver-post.php?id=<?=$comments[$c]["idpost"]?>">
                    <p class="Comment--post">
                        <?=$comments[$c]["title"]?>
                    </p>
                </a>
                
                <section class="Comment--actions">
                    <a id="btn-eliminar<?=$comments[$c]["idcomment"]?>">Eliminar</a>
                </section>
                <script>
                    var elemento = document.getElementById("btn-eliminar<?=$comments[$c]["idcomment"]?>");
                    
                    elemento.addEventListener("click", function()
                    {
                        if (window.confirm("¿Quiere borrar este comentario?")) 
                        {
                            window.location.href="http://<?=$url?>/edi2/app/posts/deleteComment.php?id=<?=$comments[$c]["idcomment"]?>&go='comments'";
                        }    
                    });
                </script>
            </article>
        <?php
            }
        ?>

    </div>
    
        

       

</main>

<?php 

require_once("../templates/footer.php");
?>
