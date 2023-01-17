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
<?php


$allInvit = $bdd->prepare('SELECT * FROM employe');
$allInvit->execute(); 
$listid = array(); 




if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
                    
          
            for($i =0; $i < count($allInvit); $i++){
                ?>
             
           
                <?php
                 
                echo "" . $allInvit[$i]['nom']."  " . $allInvit[$i]['prenom']."  " . $allInvit[$i]['sexe']."  " . $allInvit[$i]['age']."ans  " . $allInvit[$i]['telephone']."  " . $allInvit[$i]['contrat'];
                ?>
               

                </form>
             
                <?php
                }
}?>


</body>
</html>