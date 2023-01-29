<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  







if(isset($_POST['btn'])){  
    
    if(!empty($_POST['poste']) AND !empty($_POST['salaire'])AND !empty($_POST['heure'])
    AND !empty($_POST['pole'])){          

            
        $poste = $_POST['poste'];
        $salaire = $_POST['salaire'];
        $pole = $_POST['pole'];
        $heure = $_POST['heure'];
        $insertEmploye = $bdd->prepare('INSERT INTO `poste` (idPole,nomPoste,salaire,heuresSemaine) VALUES(?,?,?,?)');
        $resul = $insertEmploye->execute(array($pole,$poste,$salaire,$heure));      
        header('Location:main.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
  
    }

}


?>








<!DOCTYPE html>
<html>
<form method="POST" action="" align="center">


<h2>créer un Poste </h2>



<p class="flex"> <a href="main.php"> goBack ? </a> </p></br>

<p style="color:red;">¤ nom poste : </p>
<input type="text" name ="poste" required placeholder="ex : développeur web  " size = "25" autocomplete="off">
<p style="color:red;">¤ salaire par an: </p>

<input type="text" name ="salaire" required placeholder="ex : 29 000" autocomplete="off" size="10" maxLength="15"> €</input>
</br>
<p style="color:red;">¤ heure / semaine </p>
<input type="text" name ="heure" required placeholder="ex : 35  " size = "5" maxLength="3" autocomplete="off"> h</input>

</br>
<p style="color:red;">¤ pôle : </p>
<SELECT name="pole" size="1">
<option value="" disabled selected>choix :</option>


<?php 



$allPole = $bdd->prepare('SELECT * FROM pole ORDER BY nomPole');
$allPole->execute(); 

if ($allPole->rowCount() > 0) { 
        $allPole = $allPole->fetchAll();        
            
    for ($i = 0; $i < count($allPole); $i++){
        $nomPole = $allPole[$i]['nomPole'];
        $idPole = $allPole[$i]['idPole'];
        $final = $idPole ." ". $nomPole;
        echo "<option value= $final  >  $nomPole  </option>";
    }
    
}
?>

</SELECT>



</br>
</br>

</br>
</br>
<button type="submit" href="addEmployee.php" name="btn">Ajouter poste !</button>


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