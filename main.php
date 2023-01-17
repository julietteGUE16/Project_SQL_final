<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  


$allInvit = $bdd->prepare('SELECT * FROM invit WHERE id_user = ? ');
$allInvit->execute(array($_SESSION['id_user'])); 
$listid = array(); 

?>


<!DOCTYPE html>
<html>
<head>
    <title>Bonne étoile</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Liste des employes  : </h2>
</body>
</html>