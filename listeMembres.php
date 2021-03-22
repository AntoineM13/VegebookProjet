<?php

    include "entete.php";
    //include "navbar.html";
    include "inc\connect.php"
?>

<?php 
    $affichage = $cnx->query("SELECT * FROM membres");
    $reqadmin = $cnx->query("SELECT id_admin FROM admin");
    $tableauAdmin = $reqadmin->fetchAll();
    $compter = $cnx->query("SELECT count(id_membre) as cpt FROM membres GROUP BY id_membre");
    $compter->execute();
    $resultatCompte = $compter->fetchAll();
    $cpt = 0;
    
?>

<?php if($affichage->rowCount() >0) { ?>
    <div class="container listeMembre">
        <h1>Liste des membres</h1>
        <!-- On affiche le nombre d'utilisateur inscrit sur le site -->

        <h4>Nombre d'utilisateurs inscris : 
        <?php foreach($resultatCompte as $rc){
            $cpt++;}
            echo $cpt;
        ?>
        </h4>

    <ul>
        <!-- Boucle qui permet d'afficher les utilisateurs inscris, et de savoir si ces derniers sont admin -->
             
        <?php while($a = $affichage->fetch()) {
            echo "<div class='border-bottom'>";
            echo "Membre : " . $a['pseudo']; 
            echo " | " . "Mail : " . $a['mail'];

            foreach ($tableauAdmin as $ta){ ?>
        
        
              
                <?php 
                    if($a['id_membre'] == $ta["id_admin"]) { echo " | " . " Statut : ADMIN"; }
                ?> 
            
        
           
        <?php } 
        echo "</div>"; } ?> 
    </ul>
    </div>

<?php } else { ?>
    Aucun résultat ...
<?php } ?>

