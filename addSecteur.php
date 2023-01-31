<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  





if(isset($_POST['btn'])){  
    
    if(!empty($_POST['ville']) AND !empty($_POST['activite'])){          

            
     
        $ville = $_POST['ville'];
        $activite = $_POST['activite'];
 
        $insertSecteur = $bdd->prepare('INSERT INTO `secteur` (ville,activitePrincipale) VALUES(?,?)');
        $resul = $insertSecteur->execute(array($ville,$activite));      
        header('Location:main.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
  
    }

}


?>




<!DOCTYPE html>
<html>
<form method="POST" action="" align="center">


<h2>créer un Secteur </h2>



<p class="flex"> <a href="main.php"> goBack ? </a> </p></br>

<p style="color:red;">¤ ville : </p>
<input type="text" name ="ville" required placeholder="ex : Nantes  " size = "25" autocomplete="off">
<p style="color:red;">¤ activité principale : </p>

<input type="text" name ="activite" required placeholder="ex : centre informatique" autocomplete="off" size="40" maxLength="100"> 


</br>
</br>
</br>

<button type="submit" href="addSecteur.php" name="btn">Ajouter secteur !</button>


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