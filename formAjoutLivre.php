<?php

    include "entete.php";
    include "inc\connect.php"
?>

<div class="container">
    <form name="formAjoutE" action="ajoutLivre.php" method="post" class="form-signin">
    
       <label class="sr-only">Titre du livre</label>
       <input type="text" name="titreLivre" placeholder="Titre du livre" class="form-control" required>
       <label class="sr-only">ISBN</label>
       <input type="text" name="isbnLivre" placeholder="ISBN" class="form-control" required>
       <label class="sr-only">Année</label>
       <input type="text" name="anneeLivre" placeholder="Année de parution" class="form-control" required>
       <label class="sr-only">Auteur</label>
       <input type="text" name="nomAuteur" placeholder="Nom de l'Auteur" class="form-control" required>
       <label class="sr-only">Catégorie</label>
       <input type="text" name="libelleCategorie" placeholder="Catégorie du livre" class="form-control" required>
       <label class="sr-only">Sous-Catégorie</label>
       <input type="text" name="libelleSousCategorie" placeholder="Sous-catégorie du livre (facultatif)" class="form-control">
       <label class="sr-only">Nombre de page</label>
       <input type="text" name="nbPage" placeholder="Nombre de page" class="form-control" required>
       <label class="sr-only">Hauteur</label>
       <input type="text" name="hLivre" placeholder="Hauteur du livre" class="form-control" required>
       <label class="sr-only">Largeur</label>
       <input type="text" name="largLivre" placeholder="Largeur du livre" class="form-control" required>
       <label class="sr-only">Couverture</label>
       <input type="text" name="couvertureLivre" placeholder="Couverture (ex : 8765346.png)" class="form-control" required>
       <label class="sr-only">Editeur</label>
       <input type="text" name="editeurLivre" placeholder="Editeur du livre" class="form-control" required>
       <label class="sr-only">Notation</label>
       <input type="text" name="notation" placeholder="Note [1-5] (facultatif)" class="form-control">

       <button type="submit" class="btn btn-lg btn-success btn-block">Ajouter</button>
    </form>
</div>

