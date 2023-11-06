<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");
?>

<link rel="stylesheet" href="../assets/css/formulario.css">

<main>
    <form method="post" action ="../newPost.php">
        <p class="msg">
            <?=$_SESSION["msg"]?>
        </p>
        <legend>Nueva publicación</legend>
        <fieldset class="Main" id="main">
            <input type="text" name="title" id="title" placeholder="Título">
            <textarea name="parrafo1" id="parrafo1" cols="30" rows="10" placeholder="Prráfo 1"></textarea>
            
            
        </fieldset>
        <input type="submit" value="Publicar" name="publish">    
        <fieldset class="Opciones">
        <a id="btnNuevoParrafo" onclick=addParagrap();>Nuevo párrafo</a>
        <a id="btnEliminarParrafo" >Eliminar párrafo</a>
        </fieldset>
    </form>
</main>
<script>

    const parrafo = document.getElementById("parrafo1");
    const main = document.getElementById("main");
    const btnBorrar = document.getElementById("btnEliminarParrafo");
    let contador=1;
    function addParagrap(){
        contador++;
        let nuevoParrafo = parrafo.cloneNode(true);
        nuevoParrafo.setAttribute("name","parrafo"+contador);
        nuevoParrafo.setAttribute("id","parrafo"+contador);
        nuevoParrafo.setAttribute("placeholder","Párrafo"+contador);
        document.getElementById("main").appendChild(nuevoParrafo);
    
    }

        btnBorrar.addEventListener("click",()=>{
            if(contador >= 2){
                const textareaAEliminar = document.querySelector("#main > textarea:last-child");
                textareaAEliminar.remove();
                contador--;
            }else{
                console.log("no se puede");
            }    
            
        })

</script>

<?php
    require_once("../templates/footer.php");
?>