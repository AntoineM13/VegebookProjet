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

    <!--<div class="formulaire">-->
        <!-- <div class="text-center formulaire-connexion">
        
        
        <form method="POST" action="" class="form-signin">
            <h2 class="h3 mb-3 font-weight-normal">Inscriptions</h2>
            <table>
                <tr>
                    <td align="right">
                        <label for="pseudo">Pseudo :</label>
                    </td>
                    <td>
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" value="<?php //if(isset($pseudo)) { echo $pseudo; } ?>" />
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail">Adresse Mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Votre mail" id="mail" name="mail"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mail2">Confirmation du mail :</label>
                    </td>
                    <td>
                        <input type="email" placeholder="Confirmez votre adresse mail" id="mail2" name="mail2"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp1">Mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Votre mot de passe" id="mdp1" name="mdp1"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <label for="mdp2">Confirmation du mot de passe :</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">
                        <input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-primary"/>
                    </td>
                </tr>

            </table>    
            

           
        </form>
        <?php
        //    if (isset($erreur))
        //    {
        //        echo "<font color='red'>". $erreur. "</font>";
        //    }
        ?>

    </div> -->

    <div class="text-center formulaire-connexion">
        
        
        <form method="POST" action="" class="form-signin">
            <h2 class="h3 mb-3 font-weight-normal">Inscriptions</h2>
            
                   
                        <label for="pseudo" class="sr-only">Pseudo :</label>
                   
                        <input type="text" placeholder="Votre pseudo" id="pseudo" name="pseudo" class="form-control" value="<?php if(isset($pseudo)) { echo $pseudo; } ?>" />
                    
                
                    
                        <label for="mail" class="sr-only">Adresse Mail :</label>
                    
                        <input type="email" placeholder="Votre mail" id="mail" name="mail" class="form-control"/>
                    
                        <label for="mail2" class="sr-only">Confirmation du mail :</label>
                   
                        <input type="email" placeholder="Confirmez votre adresse mail" id="mail2" name="mail2" class="form-control"/>
                    
                        <label for="mdp1" class="sr-only">Mot de passe :</label>
                   
                        <input type="password" placeholder="Votre mot de passe" id="mdp1" name="mdp1" class="form-control"/>
                    
                        <label for="mdp2" class="sr-only">Confirmation du mot de passe :</label>
                    
                        <input type="password" placeholder="Confirmez le mot de passe" id="mdp2" name="mdp2" class="form-control"/>
                    
                        <input type="submit" name="forminscription" value="Je m'inscris" class="btn btn-lg btn-success btn-block"/>
                    
            

           
        </form>
        <?php
            if (isset($erreur))
            {
                echo "<font color='red'>". $erreur. "</font>";
            }
        ?>

    </div>

    