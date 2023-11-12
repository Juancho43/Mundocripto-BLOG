<?php
session_start();
require_once("../config/config.php");
require_once("../templates/head.php");
require_once("../templates/header.php");

if(!$_SESSION["online"]){
    header("Location: ../../");
}

?>

<link rel="stylesheet" href="../assets/css/formulario.css">

<main>
    <form class="Form" method="post" action ="editPost.php" enctype="multipart/form-data">
        <p class="msg">
            <?=$_SESSION["msg"]?>
        </p>
        <legend class="Form--legend">Editar publicación</legend>
        <input type="text" name="title" id="title" placeholder="Título" required>
        <section class="Form--content">
           <fieldset class="Form--part" id="main1">
                <textarea name="parrafo1" id="parrafo1" cols="30" rows="10" placeholder="Párrafo 1" required></textarea>
            </fieldset>
        </section>
        <fieldset class="Form--options">
            <input type="hidden" id="cantidad" name="cantidadParrafos" value="1">
            <input type="checkbox" id="publicar" name="publicar" value="true">
            <label for="publicar">¿Publicar?</label>
        </fieldset>
        <fieldset class="Form--options">
            <a id="btnCopiar">Nuevo párrafo</a>
            <a id="btnBorrar">Eliminar párrafo</a>
        </fieldset>
        <input type="submit" value="Crear" name="create">    
    </form>

</main>

<script>
    const main = document.getElementById("main1");

    let contador = 1;
    function copiarFieldset(fieldset) {
        contador++;
        const fieldsetNuevo = fieldset.cloneNode(true);
        const textareaNuevo = fieldsetNuevo.querySelector("textarea");
            
        fieldsetNuevo.setAttribute("id","main"+contador);
        textareaNuevo.setAttribute("placeholder","Párrafo"+contador);
        textareaNuevo.setAttribute("id","parrafo"+contador);
        textareaNuevo.setAttribute("name","parrafo"+contador);
        textareaNuevo.value = "";
        
        document.querySelector("section").appendChild(fieldsetNuevo);
    }

    btnCopiar.addEventListener("click", () => {
        copiarFieldset(main);
        document.getElementById("cantidad").value=contador;
    });

    function borrarFieldset() {
        if(contador >= 2){
                const fieldsetMasReciente = document.querySelector("fieldset[id='main"+contador+"']");
                fieldsetMasReciente.remove();
                contador--;
            }else{
                console.log("no se puede");
            }   
    }

    btnBorrar.addEventListener("click", () => {
        borrarFieldset();
        document.getElementById("cantidad").value=contador;
    });
   
</script>

<?php
    require_once("../templates/footer.php");
?>