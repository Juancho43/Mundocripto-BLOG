<?php
session_start();

require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/PostController.php");


if(isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$posts = new PostController($link);
$pages = $posts->PostPagination($pageno);
$total_pages = $pages["totalPages"];
$data = $posts->showPosts( $pages["inicio"], $pages["final"]);


?>
<link rel="stylesheet" href="../assets/css/feed.css">
<main>
<?php  
if($_SESSION["online"]){
    ?>
    <section class="Post--nuevo">
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/nuevo-post.php'">Crear publicación.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/feed/ver-posts.php'">Ver publicaciones.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/posts/ver-comentarios.php'">Ver comentarios.</a>
        <a onclick="window.location.href = 'http://<?=$url?>/edi2/app/users/profile.php'">Ver perfil.</a>
    </section>
    <?php
    }
    ?>
    <div class="Posts">
        
   



    

  
    
    <?php


for($c = 0; $c < count($data);$c++){
    ?>
    <a class="Post--link" href="../posts/ver-post.php?id=<?=$data[$c]["idpost"]?>">
        <section class="Post">
            <h3 class="Post--title"><?=$data[$c]["title"]?></h3>
            <h4 class="Post--author"><?=$data[$c]["nickname"]?></h4>
            <p class="Post--paragraph"><?=$data[$c]["paragraph"]?></p>
        </section>
    </a>
    <?php
    
}

?>
     </div>
     <ul class="Pagination">
            <li><a href="<?php echo "?pageno=1"; ?>"><<</a></li>
            <li class="<?php if($pageno <= 1){ echo 'Tope'; } ?>">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>"><</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'Tope'; } ?>">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">></a>
            </li>

            <li><a href="<?php echo "?pageno=$total_pages"; ?>">>></a></li>
        </ul>
</main>

<?php 

require_once("../templates/footer.php");
?>