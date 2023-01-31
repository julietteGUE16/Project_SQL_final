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


if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
            for($i =0; $i < count($allInvit); $i++){

                $nom =  $allInvit[$i]['nom'];
                $id = $allInvit[$i]['idEmploye'];


                ?>
             </br>
                <?php
                echo "" . $allInvit[$i]['nom']."  " . $allInvit[$i]['prenom']."  " . $allInvit[$i]['sexe']."  " . $allInvit[$i]['age']."ans  " . 
                $allInvit[$i]['telephone']."  " . $allInvit[$i]['contrat'];?> 
                
          
                    <form method="get" action="updateEmploye.php">
                    
                    <input type="hidden" name="idEmploye" value=" <?php echo "". $id ?>" >
               
                    <input type="submit" value ="edit employe">    </form>
                   
            </br>
           
                    <form method="get" action="deleteElement.php">
                 
                    <input type="hidden" name="idEmploye" value=" <?php echo "". $id ?>" >
                    <input type="hidden" name="type_of_delete" value=" <?php echo "". 1 ?>" >
               
                    <input type="submit" value ="delete employe">  
              
                
                    <?php
                ?>
                </br>
             
                </form>
              
                </form>
                <?php
                }
}

?>

<h2> liste des postes :  </h2>

<?php



$allInvit = $bdd->prepare('SELECT * FROM poste');
$allInvit->execute(); 


if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
            for($i =0; $i < count($allInvit); $i++){

                $nomPoste =  $allInvit[$i]['nomPoste'];
                $idPoste = $allInvit[$i]['idPoste'];


                ?>
             </br>
                <?php
                echo "" . $allInvit[$i]['nomPoste']."  " . $allInvit[$i]['heuresSemaine']."h  " . $allInvit[$i]['salaire']."€";?> 
                
               

                    <form method="get" action="deleteElement.php">
                    
                    <input type="hidden" name="idPoste" value=" <?php echo "". $idPoste ?>" >
                    <input type="hidden" name="type_of_delete" value=" <?php echo "". 2 ?>" >

               
                    <input type="submit" value ="delete poste">
                    </form>
                
                    <?php
                ?>
                </br>
               
                </form>
                <?php
                }
}

?>





<h2> liste des poles :  </h2>

<?php



$allInvit = $bdd->prepare('SELECT * FROM pole');
$allInvit->execute(); 


if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
            for($i =0; $i < count($allInvit); $i++){

                $nomPole =  $allInvit[$i]['nomPole'];
                $idPole = $allInvit[$i]['idPole'];


                ?>
             </br>
                <?php
                echo "" . $allInvit[$i]['nomPole']." : " . $allInvit[$i]['description'];?> 
                
               

                    <form method="get" action="deleteElement.php">
                    
                    <input type="hidden" name="idPole" value=" <?php echo "". $idPole ?>" >
                    <input type="hidden" name="type_of_delete" value=" <?php echo "". 3 ?>" >

               
                    <input type="submit" value ="delete pole">
                    </form>
                
                    <?php
                ?>
                </br>
               
                </form>
                <?php
                }
}

?>

<h2> liste des secteurs :  </h2>

<?php



$allInvit = $bdd->prepare('SELECT * FROM secteur');
$allInvit->execute(); 


if ($allInvit->rowCount() > 0) { 
            $allInvit = $allInvit->fetchAll();           
            for($i =0; $i < count($allInvit); $i++){

                $secteurType =  $allInvit[$i]['activitePrincipale'];
                $idSecteur = $allInvit[$i]['idSecteur'];


                ?>
             </br>
                <?php
                echo "" . $allInvit[$i]['activitePrincipale']." | ville : " . $allInvit[$i]['ville'];?> 
                
               

                    <form method="get" action="deleteElement.php">
                    
                    <input type="hidden" name="idSecteur" value=" <?php echo "". $idSecteur ?>" >
                    <input type="hidden" name="type_of_delete" value=" <?php echo "". 4 ?>" >

               
                    <input type="submit" value ="delete secteur">
                    </form>
                
                    <?php
                ?>
                </br>
               
                </form>
                <?php
                }
}

?>
</br></br>
</br>
<p class="flex"> <a href="addEmployee.php"> new employé ? </a> </p></br>

<p class="flex"> <a href="addPole.php"> new pole ? </a> </p></br>

<p class="flex"> <a href="addPoste.php"> new poste ? </a> </p></br>

<p class="flex"> <a href="addSecteur.php"> new secteur ? </a> </p></br>
</body>
</html>

