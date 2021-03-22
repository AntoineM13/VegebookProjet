<?php
    include "entete.php";
    include "inc\connect.php";
?>

<?php
    if(isset($_GET['id'])){
        $num = $_GET['id'];
        $_SESSION["numlivre"] = $num;
    }
    $sql="SELECT * FROM livre WHERE num=$num ";
    
    
    try
    {
        $resultat = $cnx->query($sql);
        $tabloResultat=$resultat->fetchAll(PDO::FETCH_ASSOC);   

        foreach($tabloResultat as $ligne)   
        {
            echo "<div class='container border'>";
            echo "<div class='row'>";
            echo "<div class='col-4'>";
            //image du livre
            echo '<p class="flotte"><img class="img-fluid" src="images/'.$ligne["couverture"].'" width="300" hspace="50"></p>';
            
            //bouton pour la redirection vers la boutique
            echo '<a href="'.$ligne['lienBoutique'].'" role="button" class="btn btn-success boutonBoutique">'."J'achète !".'</a>';
            
            if(isset($_SESSION["admin"])){ ?>
                <br/>
                <a href="modifLibrairie.php" class="boutonBoutique">Modifier la redirection</a>
    
            <?php
             }
            echo "</div>";
            echo "<div class='col'>";
            echo "<div class='contenuLivre'>";
            echo "<h2>".$ligne["titre"]."</h2>"; 
            echo "<h5> de ".$ligne["auteur"]."</h5>";
            echo "<h5> édité par ".$ligne["editeur"]. " en ". $ligne["annee"]."</h5>";
            echo "<h7>". $ligne["nbPage"]." pages, ". $ligne["hauteur"]."H x ". $ligne["largeur"] ."L </h7>";

            echo "<p class='text-justify'>"."catégorie : ".$ligne["categorie"]."</p>";
            echo "<p class='text-justify'>"." sous-catégorie : ".$ligne["sousCategorie"]."</p>";
            echo "<p class='text-justify'>".$ligne["resume"]."</p>"; 
            
            //Modification du résumé du livre (ADMIN ONLY)
            if(isset($_SESSION["admin"])){ ?>

            <a href="modifResume.php">Modifier le résumé</a>
            <?php
            }
            echo "<p class='text-justify'>";

            //Système de notation, pas optimisé et à modifier de manière brute
            echo "<br/>";
        
            if($ligne["Notation"]==1) echo "Notation : * ";
            else {
                if($ligne["Notation"]==2) echo "Notation : ** ";
                else {
                    if($ligne["Notation"]==3) echo "Notation : *** ";
                    else{
                         if($ligne["Notation"]==4) echo "Notation : **** ";
                         else {
                             if($ligne["Notation"]==5) echo "Notation : ***** "; 
                             else { echo "Pas de notation pour le moment";}
                         }
                    }
                }
            }
            
            
           
            
            
            //Modification de la note (ADMIN ONLY)
            if(isset($_SESSION["admin"])){ ?>

            <a href="modifNotation.php">Modifier la note</a>

            <?php
            }
            echo "</p>";

           
            
            echo "</div>";

            echo "</div>";
            echo "</div>";
            
                 
        }                    
    }
    catch(PDOException $e) 
    {   
        echo"ERREUR PDO  " . $e->getMessage();
    }    
?>

<?php
    //afficher les commentaires pour un livre donné
    $com = "SELECT * FROM commentaires, membres Where membres.id_membre=id_pseudo AND id_livre = $num";
    $res = $cnx->query($com);
    $tabloRes=$res->fetchAll(PDO::FETCH_ASSOC); 
    echo "<h5> Vos avis : </h5>";
    foreach($tabloRes as $ligne)   
    {
        echo "<div class='container'>";
        
        echo    "<div class='row'>";
        echo        "<div class='col border-top'>";
        echo                "<p class='flotte miseEnForme'>";
        echo                    "<h5>".$ligne["pseudo"]."</h5>";
        echo                    "<article>".$ligne["contenu"]."</article>";
        echo                "</p>";
        if(isset($_SESSION["admin"])){ 
         ?>
            <a href="deleteCommentaire.php?idCom=<?php echo $ligne['id']; ?>   "> Supprimer </a>
            
        <?php }
        echo            "</div>";
        echo        "</div>";
        echo "</div>";

        
    }

?>

<?php 
    //on affiche l'accès au poste de commentaire uniquement si l'utilisateur est enregistré
    if(isset($_SESSION["user"]) || isset($_SESSION["admin"]))
    {
        
        
        echo "<div class='commentaire border-top'>";
        echo    "<h2>Commentaires :</h2>";
        echo    "<form action='ajoutCommentaire.php' method='POST'>";
        echo        "<textarea name='commentaire' placeholder='Votre commentaire...'></textarea> <br/>";
        echo        "<input type='submit' value='Poster' name='submit_commentaire' class='btn btn-success'>";
        echo    "</form>";
        echo "</div>";
    }

?>