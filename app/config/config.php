<?php

define("HOST_DB", "localhost"); 
define("USER_DB", "root");
define("PASS_DB", "");
define("NAME_DB", "mundocripto");
define("CANT_POSTS", 10);
 
$link = new mysqli(
   constant("HOST_DB"), 
   constant("USER_DB"),
   constant("PASS_DB"),
   constant("NAME_DB")
);
function get_url() {
   // Devuelve la URL absoluta del sitio web actual.
   return $_SERVER['HTTP_HOST'];
}

function get_url_php() {
   // Devuelve la URL del archivo PHP actual.
   return $_SERVER['SCRIPT_NAME'];
 }
function formatearFecha($fechaHora){
   $fecha = new DateTime($fechaHora);
   
   $dia = date_format($fecha, "d");
   $mes = date_format($fecha, "m");
   $ano = date_format($fecha, "Y");
   $hora = date_format($fecha, "H:i");
   $fechaMostrar = "Fecha: " . $dia . "/" . $mes . "/" . $ano . " Hora: " . $hora;
   return $fechaMostrar;
}


 if(empty($_SESSION["online"])){
   $_SESSION["online"] = false;
   $_SESSION["msg"] = "Para poder interacturar inicie sesión.";
}