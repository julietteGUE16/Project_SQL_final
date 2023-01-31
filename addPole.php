<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  




if(isset($_POST['btn'])){  
    
    if(!empty($_POST['secteur']) AND !empty($_POST['pole'])AND !empty($_POST['description'])){          

            
     
        $pole = $_POST['pole'];
        $secteur = $_POST['secteur'];
        $description = $_POST['description'];
        $insertPole = $bdd->prepare('INSERT INTO `pole` (idSecteur,nomPole,`description`) VALUES(?,?,?)');
        $resul = $insertPole->execute(array($secteur,$pole,$description));      
        header('Location:main.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
  
    }

}


?>




<!DOCTYPE html>
<html>
<form method="POST" action="" align="center">


<h2>créer un Pole </h2>



<p class="flex"> <a href="main.php"> goBack ? </a> </p></br>

<p style="color:red;">¤ nom pole : </p>
<input type="text" name ="pole" required placeholder="ex : pole informatique  " size = "25" autocomplete="off">
<p style="color:red;">¤ description: </p>

<input type="text" name ="description" required placeholder="ex : gestion des bases de données..." autocomplete="off" size="40" maxLength="100"> 


</br>
<p style="color:red;">¤ secteur : </p>
<SELECT name="secteur" size="1">
<option value="" disabled selected>choix :</option>


<?php 



$allSecteur = $bdd->prepare('SELECT * FROM secteur ORDER BY activitePrincipale');
$allSecteur->execute(); 

if ($allSecteur->rowCount() > 0) { 
        $allSecteur = $allSecteur->fetchAll();        
            
    for ($i = 0; $i < count($allSecteur); $i++){
        $activitePrincipale = $allSecteur[$i]['activitePrincipale'];
        $idSecteur = $allSecteur[$i]['idSecteur'];
        $final = $idSecteur ." ". $activitePrincipale;
        echo "<option value= $final  >  $activitePrincipale  </option>";
    }
    
}
?>

</SELECT>



</br>
</br>

</br>
</br>
<button type="submit" href="addPole.php" name="btn">Ajouter pole !</button>


</form>
</html>

</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>