<?php 
    include "entete.php";
    include "inc\connect.php";
?>

<?php
    if(isset($_POST['formModification'])){
        $nouveauResume = htmlspecialchars($_POST['nouveauResume']);
        if(!empty($nouveauResume)){
            try{
                $modif = $cnx->prepare("UPDATE livre SET resume=:resume WHERE num=:numLivre");
                $modificationEffective = $modif->execute(array(':resume' => $nouveauResume, ':numLivre' => $_SESSION["numlivre"]));
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
                <label>Nouveau texte :</label>
                <input type="text" name="nouveauResume" placeholder="Le résumé du livre ..."/>
            </div>
            
            <input type="submit" name="formModification" value="Modifier" class="btn btn-primary"/>
           
        </form>

    </div>  