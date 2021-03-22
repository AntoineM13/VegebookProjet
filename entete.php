<?php

    session_start();
    include "entete.html";

if(isset($_SESSION["admin"])){
    include "navbar3.html";

} else {
    if (isset($_SESSION["user"])){
    
        include "navbar2.html";
    }
    else { 
        include "navbar.html";
    }
}


?>