<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/CommentController.php");


if(!$_SESSION["online"]){
    header("Location: ../../");
}


if(isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}



$comment = new CommentController($link);
$pages = $comment->CommentPagination($pageno, $_SESSION["iduser"]);
$comments = $comment->getComments($pages["inicio"], $pages["final"]);
$total_pages = $pages["totalPages"];



?>
<link rel="stylesheet" href="../assets/css/feed.css">
<link rel="stylesheet" href="../assets/css/post.css">
<main class="Ver--comentarios">
    <div class="Comments">

    
        <?php
            if(count($comments) > 0){
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
            }}else{
                echo"<p>Sin comentarios</p>";
            }
        ?>

    </div>
    
        

       
    <ul class="Pagination">
        <li><a href="<?php echo "?pageno=1"; ?>"><<</a></li>
        <li class="<?php if($pageno <= 1)?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
        </li>
        <li class="<?php if($pageno >= $total_pages)?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
        </li>

        <li><a href="<?php echo "?pageno=$total_pages"; ?>">>></a></li>
    </ul>
</main>

<?php 

require_once("../templates/footer.php");
?>
