<?php
session_start();
require("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
require("../controllers/CommentController.php");
require("../controllers/PostController.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}

?>

<main>
    

</main>

<?php 

require_once("../templates/footer.php");
?>
