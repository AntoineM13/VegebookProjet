<?php

    include "entete.html";
    include "navbar.html";
    include "inc\connect.php"
?>


<?php
    if (isset($_GET["s"]) AND $_GET["s"] == "Rechercher")
    {
        $_GET["terme"] = htmlspecialchars($_GET["terme"]); //pour sécuriser le formulaire contre les failles html
        $terme = $_GET["terme"];
        $terme = trim($terme); //pour supprimer les espaces dans la requête de l'internaute
        $terme = strip_tags($terme); //pour supprimer les balises html dans la requête
    

        if (isset($terme))
        {
            $terme = strtolower($terme);
            
        
            try
            {
                  
                $sql="SELECT * FROM livre, auteur, categorie, editeur WHERE livre.numAuteur=auteur.num AND livre.numCat=categorie.num AND livre.numEditeur = editeur.num";

                while($sql = $sql->fetch())
                {
                    echo "<article>";
                    echo "<h2>".$ligne["titre"]."</h2>";
                    echo "<h5> de ".$ligne["prenom"]." ".$ligne["nom"]."</h5>";
                    echo "<p>".$ligne["libelle"]."</p>";
                    echo '<img class="img-fluid" src="'.$ligne["couverture"].'" width="750" >';
                    echo "<p> Avec </p>";
                    echo "<p>".$ligne["resume"]."</p>";
                    echo "<br>";
                    echo "------------------------------------------------------------"; //ICI POUVOIR INSERER UNE LIGNE BOOTSTRAP MAYBE
                    echo "</article>";
                }
            }
            catch(PDOException $e) 
            {   
                echo"ERREUR PDO  " . $e->getMessage();
            }    
        }
    
        else
        {
            $message = "Vous devez entrer votre requete dans la barre de recherche";
        }
    }

    while($terme_trouve = $select_terme->fetch())
    {
        echo "<div><h2>".$terme_trouve['titre']."</h2>";
    }
    $select_terme->closeCursor();

?>

