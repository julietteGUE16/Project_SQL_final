<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  






if(isset($_POST['btn'])){  
    
      if(!empty($_POST['adresse']) AND !empty($_POST['age'])AND !empty($_POST['year'])
      AND !empty($_POST['month']) AND !empty($_POST['day']) AND !empty($_POST['villeBorn'])
       AND !empty($_POST['mail']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) 
       AND !empty($_POST['numSecu'])AND !empty($_POST['numTel'])AND !empty($_POST['sexe'])
       AND !empty($_POST['contrat']) AND !empty($_POST['poste'])){   

        
              

        //info $_POST['poste'] coupe au niveau des espaces donc précéddement on à mis en tête du texte l'id donc $_POST['poste'] nous donne que l'id du poste
        $idPoste =  $_POST['poste'];
        $anciennete  = "".$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        //$anciennete = strtotime($string);
        $adr = $_POST['adresse'];
        $age = $_POST['age'];
        $villeBorn = $_POST['villeBorn'];
        $mail = $_POST['mail'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $secu = $_POST['numSecu'];
        $tel = $_POST['numTel'];
        $sexe = $_POST['sexe'];
        $contrat = $_POST['contrat'];




            // echo "".$idPoste." , ". $anciennete." , ". $adr." , ".$age." , ".$villeBorn ."</br> , ". 
             //$mail ." , ". $nom ." , ".$prenom." , ".$secu." , ".$tel." , ".$sexe." , ".$contrat;

          
          $insertEmploye = $bdd->prepare('INSERT INTO `employe` (idPoste,prenom,nom,age,sexe,mail,telephone,numeroSecuriteSociale,contrat,anciennete,adressePostale,lieuNaissance) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)');
          $resul = $insertEmploye->execute(array($idPoste,$prenom,$nom,$age,$sexe,$mail,$tel,1234567893,$contrat,$anciennete,$adr,$villeBorn));      
          
         
          
        

          header('Location:main.php');
        

      } else {
       
        echo "<script>alert('veuillez compléter tous les champs !')</script>";
       
      }

}











?>




<!DOCTYPE html>
<html>
<form method="POST" action="" align="center">


<h2>créer un employé </h2>



<p class="flex"> <a href="main.php"> goBack ? </a> </p></br>

<p style="color:red;">¤ adresse postale : </p>
<input type="text" name ="adresse" required placeholder="ex : 40 rue du général de gaulle 44000 nantes  " size = "40" autocomplete="off">
<p style="color:red;">¤ âge de l'employé : </p>

<input type="text" name ="age" required placeholder="ex : 29" autocomplete="off" size="1" maxLength="3"> ans</input>
</br>
<p style="color:red;">¤ ancienneté : </p>
<p> year : 
<input type="text" name ="year" required placeholder="ex : 2023" autocomplete="off" size="4" maxLength="4"> </p>
<p> month :
<input type="text" name ="month" required placeholder="ex : 01" autocomplete="off" size="2" maxLength="2"> </p>
<p> day :
<input type="text" name ="day" required placeholder="ex : 15" autocomplete="off" size="2" maxLength="2"> </p>
<p style="color:red;">¤ type de contrat : </p>
<SELECT name="contrat" size="1">
<option value="" disabled selected>choix :</option>
<option value="CDD">CDD</option>
<option value="CDI">CDI</option>
<option value="Alternance">Alternance</option>
<option value="Stage">Stage</option>
</SELECT>
<p style="color:red;">¤ poste disponible : </p>


<SELECT name="poste" size="1">
<option value="" disabled selected>choix :</option>


<?php 


$myArrayIdPoste = array();

//on recup les postes qui n'ont pas d'employés
$allidPost = $bdd->prepare('SELECT poste.idPoste FROM poste WHERE idPoste NOT IN (SELECT poste.idPoste FROM poste 
                            INNER JOIN employe ON poste.idPoste = employe.idPoste) ORDER BY poste.idPoste');
$allidPost->execute();

if ($allidPost->rowCount() > 0) { 
    $allidPost = $allidPost->fetchAll();  
   

   //on stock dans un tableau les id
    for ($j = 0; $j < count($allidPost); $j++){
        array_push($myArrayIdPoste, $allidPost[$j]['idPoste']);
     
    }

}else {
    echo "pas de poste disponible";
}

//echo "taille : " . count($myArrayIdPoste). "------". "</br>";



$allPoste = $bdd->prepare('SELECT * FROM poste ORDER BY nomPoste');
$allPoste->execute(); 

if ($allPoste->rowCount() > 0) { 
        $allPoste = $allPoste->fetchAll();           

    
for ($i = 0; $i < count($allPoste); $i++){
  
    $nomPoste = $allPoste[$i]['nomPoste'];
    $idPoste = $allPoste[$i]['idPoste'];
  

 
    //regle le problème de disparition de texte
    $final = $idPoste ." ". $nomPoste;

    if(in_array($idPoste, $myArrayIdPoste)){
       

        echo "<option value= $final  >  $nomPoste  </option>";
    } else {     
   
   
        echo "<option value='' disabled selected> $nomPoste  </option>";
    }
  
}
    
        }
?>
</SELECT>




<p class="flex"> <a href="addPoste.php"> créer un poste ? (attention vous allez tout perdre) </a> 

<p style="color:red;">¤ ville ou commune de naissance : </p>
<input type="text" name ="villeBorn" required placeholder="ex : saint-Herblain" autocomplete="off">

<p style="color:red;">¤ mail : </p>
<input type="text" name ="mail" required placeholder="ex : nom.prenom@gmail.com" autocomplete="off">

<p style="color:red;">¤ nom : </p>
<input type="text" name ="nom" required placeholder="ex : dupont" autocomplete="off">

<p style="color:red;">¤ prénom : </p>
<input type="text" name ="prenom" required placeholder="ex : jean" autocomplete="off">

<p style="color:red;">¤ numéro de sécurité social (10 max et pas de 0) : </p>
<input type="numnber" name ="numSecu" required placeholder="ex : 1111111111" autocomplete="off" maxlength="10" >

<p style="color:red;">¤ sexe: </p>
<SELECT name="sexe" size="1">
<option value="" disabled selected>choix :</option>
<option value="homme">homme</option>
<option value="femme">femme</option>
<option value="autre">autre</option>
</SELECT>

<p style="color:red;">¤ numéro de téléphone portable (sans espace) : </p>
<input type="text" name ="numTel" required placeholder="ex : 06 14 58 25 25" autocomplete="off" maxlength="10" >

</br>
</br>
</br>
<button type="submit" href="addEmployee.php" name="btn">Ajouter l'employé !</button>


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