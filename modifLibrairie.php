<?php 
    include "entete.php";
    include "inc\connect.php";
?>

<?php
    if(isset($_POST['formModification'])){
        $librairie = $_POST['nouvelleLibrairie'];
        if(!empty($librairie)){
            try{
                $modif = $cnx->prepare("UPDATE livre SET lienBoutique=:lienBoutique WHERE num=:numLivre");
                $modificationEffective = $modif->execute(array(':lienBoutique' => $librairie, ':numLivre' => $_SESSION["numlivre"]));
            }
            catch(PDOException $e){
                echo "ERREUR dans la modification ". $e->getMessage();
            }
            

        }
    }
?>

    <div class="formulaire" >
        <h2>Modification</h2>
        <br /><br />
        <form method="POST" action="">
            <div class="form-group">
                <label>Nouvelle adresse (http://...) :</label>
                <input type="text" name="nouvelleLibrairie" placeholder=""/>
               
            </div>
            
            <input type="submit" name="formModification" value="Modifier" class="btn btn-primary"/>
           
        </form>

    </div>  