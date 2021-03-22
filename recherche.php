<?php
    
    include "entete.php";
    //include "navbar.html";
    include "inc\connect.php"
?>

<?php

    //algorithme de recherche, qui cherche le champ (ici q) dans la base donnée

    $livreRecherche = $cnx->query('SELECT titre,num FROM livre');
    if(isset($_GET['q']) AND !empty($_GET['q']))
    {
        $q = htmlspecialchars($_GET['q']);

        if($_GET['listeCatégorie']=="parTitre")
        {
             $livreRecherche = $cnx->query('SELECT titre,num FROM livre WHERE titre LIKE "%'.$q.'%"');
             
        }
        else
        {
            if($_GET['listeCatégorie']=="parCatégorie")
            {
                $livreRecherche = $cnx->query('SELECT titre,num FROM livre WHERE categorie LIKE "%'.$q.'%"');
            }
            else
            {
                if($_GET['listeCatégorie']=="parAuteur")
                {
                    $livreRecherche = $cnx->query('SELECT titre,num FROM livre WHERE auteur LIKE "%'.$q.'%"');
                }
                else
                {
                    if($_GET['listeCatégorie']=="parSousCatégorie")
                    {
                        $livreRecherche = $cnx->query('SELECT titre,num FROM livre WHERE sous_catégorie LIKE "%'.$q.'%"');
                    }
                }
            }
        }
        
    }
    


?>

<br/>
<form method="GET" >
    <div class="input-group container">
        <div class="form-outline">
            <input type="search" name="q" placeholder="Recherche ..." class="form-control"/>
        </div>
        <!-- On cherche ici à cibler les champs voulus, ce qui permet de les différencier et de
             préciser la recherche au maximum dans l'algorithme -->
        <select name="listeCatégorie"> 
            <option value="tousType" selected="selected">Tous</option>
            <option value="parTitre">Titre</option>
            <option value="parCatégorie">Catégorie</option>
            <option value="parAuteur">Auteur</option>
            <option value="parSousCatégorie">Sous-Catégorie</option>
        </select>
    
        <input type="submit" value="Valider" class="btn btn-success"/>
    </div>
</form>

<?php if($livreRecherche->rowCount() >0) { ?>
    <div class="container">
    <ul>
        <!-- Boucle qui permet d'afficher les livres recherchés, et en cliquant sur le lien permet d'envoyer le
             bon num à "afficheLivre.php -->
             
        <?php while($a = $livreRecherche->fetch()) { ?>
        <br/>
        <div class='container'>
            <a href="afficheLivre.php?id=<?php echo $a['num']; ?>" class="couleurLien">   <?= $a['titre']; ?> 
                                                     </a> 
        </div>
           
        <?php } ?>  
    </ul>
    </div>

<?php } else { ?>
    Aucun résultat pour : <?= $q ?> ...
<?php } ?>


