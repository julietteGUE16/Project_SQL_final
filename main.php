<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  


?>


<!DOCTYPE html>
<html>
<head>
    <title>Bonne étoile</title>
    <meta charset="utf-8">
</head>
<body>
<h2>Liste des employes  : </h2>
</br>
<form name="fo" method="get" action ="">
<input type="text" name="keywords" placeholder="nom..." />
<input type="submit" name="valider" value="Rechercher" />
</form>           
<?php



$allInvit = $bdd->prepare('SELECT * FROM employe');
$allInvit->execute(); 
$listid = array(); 

if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
            for($i =0; $i < count($allInvit); $i++){
                ?>
             </br>
                <?php
                echo "" . $allInvit[$i]['nom']."  " . $allInvit[$i]['prenom']."  " . $allInvit[$i]['sexe']."  " . $allInvit[$i]['age']."ans  " . $allInvit[$i]['telephone']."  " . $allInvit[$i]['contrat'];
                ?>
                </form>
                <?php
                }
}?>


<p class="flex"> <a href="addEmployee.php"> new employee ? </a> </p></br>
</br>
<p class="flex"> <a href="addPole.php"> new pole ? </a> </p></br>
</br>
<p class="flex"> <a href="addPoste.php"> new poste ? </a> </p></br>
</br>
<p class="flex"> <a href="addSecteur.php"> new secteur ? </a> </p></br>
</body>
</html>