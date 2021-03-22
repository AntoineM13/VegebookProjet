<?php

    include "entete.php";
    //include "navbar.html";
    include "inc\connect.php"
?>

<?php

    if(isset($_POST['forminscription']))
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $mail = htmlspecialchars($_POST['mail']);  
        $mail2 = htmlspecialchars($_POST['mail2']);  
        $mdp1 = ($_POST['mdp1']);
        $mdp2 = ($_POST['mdp2']);

        $hashedpass = password_hash($mdp1, PASSWORD_DEFAULT);
        
        if(!empty($_POST['pseudo']) AND !empty($_POST['mail']) AND !empty($_POST['mail2']) AND !empty($_POST['mdp1']) AND !empty($_POST['mdp2']))
        {


            $pseudolength = strlen($pseudo);
            if ($pseudolength <= 255)
            {
                $reqpseudo = $cnx->prepare("SELECT * FROM membres WHERE pseudo = ?");
                $reqpseudo->execute(array($pseudo));
                $pseudoexist = $reqpseudo->rowCount();

                if($pseudoexist == 0)
                {
                    if ($mail == $mail2)
                    {
                        if(filter_var($mail, FILTER_VALIDATE_EMAIL))
                        {
                            $reqmail = $cnx->prepare("SELECT * FROM membres WHERE mail = ?");
                            $reqmail->execute(array($mail));
                            $mailexist = $reqmail->rowCount();
                            if($mailexist == 0)
                            {
                                if($mdp1 == $mdp2)
                                {
                                    $insertmbr = $cnx-> prepare("INSERT INTO membres(pseudo, mail, motdepasse) VALUES(?, ?, ?)");
                                    $insertmbr->execute(array($pseudo, $mail, $hashedpass));
                                    
                                    $_SESSION['comptecree'] = "Votre compte a bien été créé !";
                                    header('Location: index.php');

                                    
                                }
                                else
                                {
                                    $erreur = "Les mots de passes ne correspondent pas !";
                                }
                            }
                            else
                            {
                                $erreur = "Adresse mail déjà utilisée !";
                            }
                           
                        }
                        else
                        {
                            $erreur = "Votre adresse mail n'est pas valide !";
                        }
                    }
                    else
                    {
                        $erreur = "Les adresses mails ne correspondent pas !";
                    }
                }
                else
                {
                    $erreur = "Le pseudo existe déjà !";
                }
                
               
            }
            else
            {
                $erreur = "Votre pseudo ne doit pas dépasser 255 caractères !";
            }
        }
        else
        {
            $erreur = "Tous les champs doivent être complétés !";
        }
    }
?>

    <div class="formulaire">
        <h2>Inscriptions</h2>
        <br /><br />
        <form method="POST" action="">
            
            <div class="form-group row">
                <label for="pseudo" class="col-sm-2 col-form-label">Pseudo :</label>
                <div class="col-sm-10">
                    <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                </div>
            </div>
            <div class="form-row">
            <div class="form-group col-md-6">
                <label for="mail">Email</label>
            
                <input type="email" placeholder="Votre mail" id="mail" name="mail"/>
            </div>
                <label for="mail2">Confirmation</label>
            
                <input type="email" placeholder="Confirmez votre adresse mail" id="mail2" name="mail2"/>
            </div>
            </div>

            <div class="form-group">
                <label for="mdp1">Mot de passe :</label>
            
                <input type="password" placeholder="Votre mot de passe" id="mdp1" name="mdp1"/>
            </div>
        
            <div class="form-group">
                <label for="mdp2">Confirmation du mot de passe :</label>
            
                <input type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2"/>
            </div>

            </div>
            <input type="submit" name="forminscription" value="Je m'inscris"/>
           
        </form>

        <?php
            if (isset($erreur))
            {
                echo "<font color='red'>". $erreur. "</font>";
            }
        ?>

    </div>


