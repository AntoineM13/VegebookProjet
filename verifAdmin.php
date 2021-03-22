<?php

    session_start();
    include "inc\connect.php";
    include "entete.php";

    $sql="SELECT pseudo,mdpasse FROM admin";
        
    try{
        $verif=0;
        $resultat = $cnx->query($sql); 
            
        $tabloResultat=$resultat->fetchAll(PDO::FETCH_ASSOC);                   
                
        foreach($tabloResultat as $ligne)   
        {
                    
            if ( $_POST["psd"]==$ligne["pseudo"] and $_POST["pwd"]==$ligne["mdpasse"] )
            {
                $verif=1;

            }

            else
            {
                $verif=2;
            }
        }

        if($verif==1)
        {
            $_SESSION["admin"]=$_POST["psd"];
            header("Location: index.php");
        }

        else
        {
            echo "Cet utilisateur n'est pas administrateur";

        }

    }

        
    catch(PDOException $e) {   // gestion des erreurs
        echo"ERREUR PDO  " . $e->getMessage();
    }    
    
?>