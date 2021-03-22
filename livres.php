<?php

    include "entete.html";
    include "navbar.html";
    include "inc\connect.php"
?>

<!----------------------- SECTION -->
  <section>

        <!----------------------- 8 colonnes -->
        
        <div class="col-sm-8">
       

        <?php
            $sql="SELECT * FROM livre";
        
            try
            {
                $resultat = $cnx->query($sql); 
                $tabloResultat=$resultat->fetchAll(PDO::FETCH_ASSOC);   

                foreach($tabloResultat as $ligne)   
                {
                    echo "<article>";
                    echo "<h2>".$ligne["titre"]."</h2>";
                    echo "<h5> de ".$ligne["auteur"]."</h5>";
                    echo "<p>".$ligne["categorie"]."</p>";
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
        ?>


        </div>
    </section>
 
 <?php include "footer.html"; ?>