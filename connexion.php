<?php
    include "entete.php";
    //include "navbar.html";
    include "inc\connect.php"
?>

<?php

    if(isset($_POST['formconnexion']))
    {
        $pseudoconnect = htmlspecialchars($_POST['pseudoconnect']);
        $mdpconnect = ($_POST['mdpconnect']);
        $hashedpassconnect = password_hash($mdpconnect, PASSWORD_DEFAULT);
        
        if(!empty($pseudoconnect) AND !empty($mdpconnect))
        {
            $requser = $cnx->prepare("SELECT * FROM membres WHERE pseudo =:pseudo");

            $reqadmin = $cnx->query("SELECT * FROM admin");
            $resultAdmin = $reqadmin->fetchAll(PDO::FETCH_ASSOC);

            $requser->execute(array('pseudo' => $_POST['pseudoconnect']));
            $result = $requser->fetch();
            if ($result && password_verify($_POST['mdpconnect'], $result['motdepasse']))
            {
                $userexist = $requser->rowCount();
                
                if($userexist == 1)
                {
                    // boucle pour comparer les résultats de la table admin avec la requete user
                    foreach($resultAdmin as $ra){

                        if($result['id_membre'] == $ra["id_admin"]){
                            $_SESSION['admin'] = $result['id_membre'];
                            //echo "connecté en tant qu'administrateur";
                            header("Location: index.php?");

                        }
                        else
                        {
                            $_SESSION['user'] = $result['id_membre'];
                            //echo "connecté en tant qu'utilisateur";
                            header("Location: index.php?");
                        }
                    }

                   
                }
                else
                {
                    $erreur = "L'utilisateur n'existe pas !";
                }
            }
            else
            {
                $erreur = "L'utilisateur n'existe pas !";
            }
            
        }
        else
        {
            $erreur = "Tous les champs doivent être renseignés !";
        }
    }

?>

<!-- <div class="formulaire" >
        <h2>Connexion</h2>
        <br /><br />
        <form method="POST" action="">
            <div class="form-group">
                <label>Pseudo</label>
                <input type="text" name="pseudoconnect" placeholder="Pseudo"/>
            </div>
            <div class="form-group">
                <label>Mot de passe</label>
                <input type="password" name="mdpconnect" placeholder="Mot de passe"/>
            </div>
            <input type="submit" name="formconnexion" value="Se connecter" class="btn btn-primary"/>
           
        </form>

        // <?php
        //    if (isset($erreur))
        //    {
        //        echo "<font color='red'>". $erreur. "</font>";
        //    }
        // ?>

    </div> -->
    

    <div class="text-center formulaire-connexion">
        
        
        <form method="POST" action="" class="form-signin">
            
            <h2 class="h3 mb-3 font-weight-normal">Connexion</h2>
            
            <label class="sr-only">Pseudo</label>
            <input type="text" name="pseudoconnect" placeholder="Pseudo" class="form-control"/>
        
        
            <label class="sr-only">Mot de passe</label>
            <input type="password" name="mdpconnect" placeholder="Mot de passe" class="form-control"/>
            
            <input type="submit" name="formconnexion" value="Se connecter" class="btn btn-lg btn-success btn-block"/>
           
        </form>
    </div>
        <?php
            if (isset($erreur))
            {
                echo "<p class='text-center'><font color='red'>". $erreur. "</font></p>";
            }
        ?>

     