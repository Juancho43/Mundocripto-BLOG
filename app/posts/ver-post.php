<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/PostController.php");
require("../controllers/CommentController.php");


$post = new PostController($link);
$postData = $post->showPost($_GET["id"]);
$comment = new CommentController($link);
$comments = $comment->showComments($postData[0]["idpost"]);
$paragraphs = $post->showParagraps($postData[0]["idpost"]);
$cantidadComentarios = count($comments);
?>

<link rel="stylesheet" href="../assets/css/feed.css">
<link rel="stylesheet" href="../assets/css/post.css">
<main class="Ver--posts">

    <section class="Post">
        <section class="Post--header">
            <h3 class="Post--title"><?=$postData[0]["title"]?></h3>
            <h4 class="Post--date">Creado: <?=formatearFecha($postData[0]["date"]);?></h4>
        </section>
        <section class="Post--paragraphs">
            <?php
                for($i=0;$i<count($paragraphs);$i++){
                    echo "<p class='Post--paragraph'>".$paragraphs[$i]["paragraph"]."</p>";
                }
            ?>
        </section>
    </section>
    <section class="Post--Comments">
        <?php
            if($_SESSION["online"])
            {
        ?>
            <form class="newComment" method="POST" action="newComment.php">
                <legend>Añadir comentario:</legend>
                <fieldset>
                    <textarea name="comment" id="" cols="30" rows="10" placeholder="¿Qué opinas de la publicacion?" required></textarea>
                    <input type="hidden" name="idpost" value="<?=$_GET["id"]?>">
                    <input type="submit" value="Publicar" name="newComment">
                </fieldset>
            </form>
        <?php
            }else{
                ?>
                <p>
                    Para comentar es necesario tener una cuenta:
                    <a href="../users/iniciar-sesion.php">inicie sesión</a>
                </p>
                    
                <?php
            }
        ?>
      
        <article class="Comments">
        <h3>Comentarios:</h3>
            <?php
                if($cantidadComentarios > 0)
                {
                    for($i=0;$i<$cantidadComentarios;$i++){
                        ?>
                        <div class='Comment'>
                            <div class="Comment--info">
                                <h4><?=$comments[$i]["nickname"]?> dijo:</h4>
                                <h4><?=formatearFecha($comments[$i]["date"]);?></h4>
                                <?php
                                    if($_SESSION["online"])
                                    {
                                        if($_SESSION["iduser"] == $comments[$i]["author"] )
                                        {
                                            echo "<p title='Eliminar comentario.' id='btn-eliminar".$comments[$i]["idcomment"]."'>X<p>";
                                        }
                                    }

                                ?>
                            </div>
                            
                            <p class='Comment-body'><?=$comments[$i]["comment"]?></p>
                        </div>
                        <script>
                            var elemento = document.getElementById("btn-eliminar<?=$comments[$i]["idcomment"]?>");
                            elemento.addEventListener("click", function(){
                                if (window.confirm("¿Quiere eliminar este comentario?")) {
                                    window.location.href="http://<?=$url?>/edi2/app/posts/deleteComment.php?id=<?=$comments[$i]["idcomment"]?>&idPost=<?=$_GET["id"]?>";
                                }

                            });
                        </script>
                        <?php
                    }
                }else{
                    echo "<p>¡Sé el primero en comentar!</p>";
                }
                
            ?>
        </article>
      
    </section>


</main>

<?php 

require_once("../templates/footer.php");
?>
