<?php 
    include "entete.php";
    include "inc\connect.php";
?>

<?php
    if(isset($_POST['formModification'])){
        $notation = $_POST['listeNotation'];
        if(!empty($notation)){
            try{
                $modif = $cnx->prepare("UPDATE livre SET Notation=:notation WHERE num=:numLivre");
                $modificationEffective = $modif->execute(array(':notation' => $notation, ':numLivre' => $_SESSION["numlivre"]));
                

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
                <label>Nouvelle notation :</label>
                <!-- <input type="text" name="nouvelleNotation" placeholder=""/> -->
                <select name="listeNotation"> 
                    <option value="1" selected="selected">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                </select>
            </div>
            
            <input type="submit" name="formModification" value="Modifier" class="btn btn-primary"/>
           
        </form>

    </div>  