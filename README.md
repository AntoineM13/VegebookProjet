# VegebookProjet
1/ Afin d'utiliser le site, avant toute chose vous devez :
 -> Si le site est utilisé en localhost, installer XAMPP et lancer la connexion Apache et MySQL.
	Il faut ensuite créer la base de donnée dans phpMyAdmin en copiant le contenu de vegebook.sql
	Il faut ensuite glisser le dossier "SiteProjet" dans le dossier htdocs de XAMPP dans le disque local C.
	Pour finir, il faut se rendre sur votre navigateur, et il faut entrer : " localhost/SiteProjet " (sans les "").

 -> Cette méthode est la manière qui nous a été enseigné en l3 Gestion, si vous disposez d'une autre manière pour accéder
	à la base de données, prenez en compte que j'ai travaillé sur le langage MySQL afin de créer la base.

2/ Une fois la base de donnée crée, vous voudriez modifier le l'ID de l'administrateur ou bien en ajouter. Il faut donc entrer
dans la table administrateur, et mettre l'ID de l'utilisateur qui deviendra administrateur. Vous pouvez créer un membre 
directement depuis la BDD, ou bien via le site avec l'onglet "Inscription". 

De même pour les livres, il y a déjà une sélection de livre disponible sur la base, vous pouvez décider de la reset pour
mettre vos livres, ou bien en ajouter soit sur la base soit via le site avec l'onglet "Ajouter un livre".

3/ Le nom de la base de donnée est très importante : il faut qu'elle corresponde au nom donné dans la page connect.php (dossier inc) !
Si le nom n'est pas vegebook, il faut le modifier dans la variable $connect_str, sinon il faut veiller à avoir exactement le même nom (majuscules et minuscules comprises).
