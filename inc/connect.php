<?php                            
try {
    $connect_str = "mysql:host=localhost;dbname=vegebook"; // chaine de connexion
    $connect_user = "root";
    $connect_pass = "";
    $options[PDO::ATTR_ERRMODE]= PDO::ERRMODE_EXCEPTION; 
    // Instancier un objet de la classe PDO $cnx pour la connexion :
    $cnx = new PDO($connect_str, $connect_user, $connect_pass , $options);
    $cnx->exec("set names utf8");  // pour les caractères spéciaux(encodage utf8)
}
catch(PDOException $e) {   // gestion des erreurs
    echo "ERREUR PDO " . $e->getMessage();
 }
 ?>
