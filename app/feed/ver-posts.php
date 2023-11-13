<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/PostController.php");

if(!$_SESSION["online"]){
    header("Location: feed.php");
}

if(isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$posts = new PostController($link);
$pages = $posts->PostPagination($pageno);
$total_pages = $pages["totalPages"];
$data = $posts->showOwnPosts($pages["inicio"], $pages["final"]);

?>
<link rel="stylesheet" href="../assets/css/feed.css">

<main>
    <section class="Post--nuevo">
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/nuevo-post.php'">Crear publicación.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/feed.php'">Ver feed.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/posts/ver-comentarios.php'">Ver comentarios.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/users/profile.php'">Ver perfil.</a>
    </section>
    <div class="Posts">
        <?php
            for($c = 0; $c < count($data);$c++){
        ?>
            <article class="Post">
                <a class="Post--link" href="../posts/ver-post.php?id=<?=$data[$c]["idpost"]?>">
                    <h3 class="Post--title"><?=$data[$c]["title"]?></h3>
                    <h4 class="Post--author"><?=$data[$c]["nickname"]?></h4>
                    <h4 class="Post--author">
                        <?php if($data[$c]["status"] == 1)
                            {
                            echo "Publicado";
                            }else{
                                echo "Borrador";
                            }
                        ?>  
                    <h4 class="Post--author"></h4>
                    <p class="Post--paragraph"><?=$data[$c]["paragraph"]?></p>
                </a>
                <section class="Post--actions">
                        <?php if($data[$c]["status"] == 0){
                            echo "<a href='../posts/publishPost.php?id=".$data[$c]["idpost"]."'>Publicar</a>";
                            }else{
                                echo "<a href='../posts/unpublishPost.php?id=".$data[$c]["idpost"]."'>Despublicar</a>"; 
                            }
                        ?> 
                    <a href="../posts/editar-post.php?id=<?=$data[$c]["idpost"]?>">Editar</a>
                    <a id="btn-eliminar<?=$data[$c]["idpost"]?>">Eliminar</a>
                </section>
            </article>       
            <script>
                var elemento = document.getElementById("btn-eliminar<?=$data[$c]["idpost"]?>");
                 
                elemento.addEventListener("click", function()
                {
                    if (window.confirm("¿De verdad quiere eliminar esta publicación?")) 
                    {
                        window.location.href="http://<?=$url?>/edi2/app/posts/deletePost.php?id=<?=$data[$c]["idpost"]?>";
                    }    
                });
            </script>

        <?php
            }
        ?>
    </div>
    <ul class="Pagination">
        <li><a href="<?php echo "?pageno=1"; ?>"><<</a></li>
        <li class="<?php if($pageno <= 1) ?>">
            <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
        </li>
        <li class="<?php if($pageno >= $total_pages) ?>">
            <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
        </li>

        <li><a href="<?php echo "?pageno=$total_pages"; ?>">>></a></li>
    </ul>
</main>




<?php 
    require_once("../templates/footer.php");
?>
