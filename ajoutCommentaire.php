<?php
    include "entete.php";
    include "inc\connect.php";

    $sql="insert into commentaires(id_pseudo,id_livre,contenu) values(:id_pseudo, :id_livre, :contenu)";

    try{
        $resultat = $cnx->prepare($sql);
        if (isset($_SESSION["user"])){
            $id_pseudo = $_SESSION["user"];
        }
        else{
            $id_pseudo = $_SESSION["admin"];
        }
        
        $id_livre = $_SESSION["numlivre"];
        $contenu = $_POST["commentaire"];

        //si la requête a fonctionné, affiche un message pour dire que le commentaire a été ajouté
        $nbLignes = $resultat->execute(array(":id_pseudo" => $id_pseudo,":id_livre" => $id_livre, ":contenu" => $contenu));
        echo ($nbLignes . ' commentaire ajouté');
        
        header ("Location: $_SERVER[HTTP_REFERER]" );

    }

    catch(PDOException $e){
        echo "ERREUR dans l'ajout ". $e->getMessage();
    }


?>