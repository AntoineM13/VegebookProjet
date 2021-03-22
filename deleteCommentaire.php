<?php 
    include "entete.php";
    include "inc\connect.php";
?>

<?php 
    if(isset($_GET['idCom'])){
        $idCommentaire = $_GET['idCom'];
        
    }

    $sql="DELETE FROM commentaires WHERE id=$idCommentaire";
    if ($cnx->query($sql) == TRUE) {
        echo "Le commentaire a bien été supprimé";
    
    }

?>