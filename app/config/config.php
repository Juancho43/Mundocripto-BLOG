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

 if(empty($_SESSION["online"])){
   $_SESSION["online"] = false;
   $_SESSION["msg"] = "Para poder interacturar inicie sesión.";
}