<?php

    include "entete.php";
    include "inc\connect.php";
?>

<?php


    $sql="insert into livre(ISBN,titre,annee,auteur,categorie,sousCategorie,nbPage,hauteur,largeur,couverture,editeur,Notation) values(:ISBN,:titre,:annee,:auteur,:categorie,:sousCategorie,:nbPage,:hauteur,:largeur,:couverture,:editeur,:notation)";

    try{
        
        $resultat = $cnx->prepare($sql);
        $ISBN = $_POST["isbnLivre"];
        $titre = $_POST["titreLivre"];
        $annee = $_POST["anneeLivre"];
        $auteur = $_POST["nomAuteur"];
        $categorie = $_POST["libelleCategorie"];
        $souscategorie = $_POST["libelleSousCategorie"];
        $nbPage = $_POST["nbPage"];
        $hauteur = $_POST["hLivre"];
        $largeur = $_POST["largLivre"];
        $couverture = $_POST["couvertureLivre"];
        $editeur = $_POST["editeurLivre"];
        $notation = $_POST["notation"];
        $nbLignes = $resultat->execute(array(":ISBN" => $ISBN, ":titre" => $titre,":annee" => $annee, ":auteur" => $auteur, ":categorie" => $categorie, ":sousCategorie" => $souscategorie,":nbPage" => $nbPage, ":hauteur" => $hauteur, ":largeur" => $largeur, ":couverture" => $couverture, ":editeur" => $editeur, ":notation" => $notation));
        echo $nbLignes. " ligne ajoutée";
    }

    catch(PDOException $e){
        echo "ERREUR dans l'ajout ". $e->getMessage();
    }


?>