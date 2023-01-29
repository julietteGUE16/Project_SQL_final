<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  



//var contexte employe qu'on a envoyé depuis la page main/home:

$var_idEmploye = $_GET['idEmploye'];

$theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idEmploye = ? ');
$theEmploye->execute(array($var_idEmploye)); 


if ($theEmploye->rowCount() > 0) { 
        $theEmploye = $theEmploye->fetchAll();           

    
for ($i = 0; $i < count($theEmploye); $i++){


    $_POST['poste']= $idPosteEmp =  $theEmploye[$i]['idPoste'];
    $_POST['anciennete']= $anciennete  = $theEmploye[$i]['anciennete'];
    $_POST['adresse']= $adr = $theEmploye[$i]['adressePostale'];
    $_POST['age']= $age = $theEmploye[$i]['age'];
    $_POST['villeBorn']=$villeBorn = $theEmploye[$i]['lieuNaissance'];
    $_POST['mail']=$mail = $theEmploye[$i]['mail'];
    $_POST['nom']= $nom = $theEmploye[$i]['nom'];
    $_POST['prenom']=$prenom = $theEmploye[$i]['prenom'];
    $_POST['numSecu']=$secu = $theEmploye[$i]['numeroSecuriteSociale'];
    $_POST['numTel']=$tel = $theEmploye[$i]['telephone'];
    $_POST['sexe']= $sexe = $theEmploye[$i]['sexe'];
    $_POST['contrat']=$contrat = $theEmploye[$i]['contrat'];




        }   
}


   


if(isset($_POST['btn'])){  
    
      if(!empty($_POST['adresse']) AND !empty($_POST['age'])AND !empty($_POST['anciennete']) AND !empty($_POST['villeBorn'])
       AND !empty($_POST['mail']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) 
       AND !empty($_POST['numSecu'])AND !empty($_POST['numTel'])AND !empty($_POST['sexe'])
       AND !empty($_POST['contrat']) AND !empty($_POST['poste'])){   

     

        //info $_POST['poste'] coupe au niveau des espaces donc précéddement on à mis en tête du texte l'id donc $_POST['poste'] nous donne que l'id du poste
        $idPoste2 =  $_POST['poste'];
        $anciennete2  = "".$_POST['year']."-".$_POST['month']."-".$_POST['day'];
        //$anciennete = strtotime($string);
        $adr2 = $_POST['adresse'];
        $age2 = $_POST['age'];
        $villeBorn2 = $_POST['villeBorn'];
        $mail2 = $_POST['mail'];
        $nom2 = $_POST['nom'];
        $prenom2 = $_POST['prenom'];
        $secu2 = $_POST['numSecu'];
        $tel2 = $_POST['numTel'];
        $sexe2 = $_POST['sexe'];
        $contrat2 = $_POST['contrat'];


            echo "test";

            // echo "".$idPoste." , ". $anciennete." , ". $adr." , ".$age." , ".$villeBorn ."</br> , ". 
             //$mail ." , ". $nom ." , ".$prenom." , ".$secu." , ".$tel." , ".$sexe." , ".$contrat;

          
          $updateEmploye = $bdd->prepare('UPDATE `employe` SET idPoste =? AND prenom=?AND nom=? AND age=? AND sexe=?AND mail=? AND telephone=? AND numeroSecuriteSociale=? AND contrat=?  AND anciennete=?AND adressePostale=? AND lieuNaissance=? WHERE idEmploye = ?');
          $resul = $updateEmploye->execute(array($idPoste2,$prenom2,$nom2,$age2,$sexe2,$mail2,$tel2,$secu2,$contrat2,$anciennete2,$adr2,$villeBorn2,$var_idEmploye));      
          
         
          
        

          header('Location:main.php');
        

      } else {
       
       
        echo "test : ".   !empty($_POST['mail']) ;//AND !empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['numSecu'])AND !empty($_POST['numTel'])AND !empty($_POST['sexe'])       AND !empty($_POST['contrat']) AND !empty($_POST['poste'])
       
       
       
        // echo "<script>alert('veuillez compléter tous les champs !')</script>";
       
      }

}











?>




<!DOCTYPE html>
<html>
<form method="POST" action="" align="center">


<h2>éditer un employé </h2>



<p class="flex"> <a href="main.php"> goBack ? </a> </p></br>

<p style="color:red;">¤ adresse postale : </p>
<input type="text" name ="adresse" value ="<?php echo "". $adr ?>" required placeholder="ex : 40 rue du général de gaulle 44000 nantes  " size = "40" autocomplete="off">
<p style="color:red;">¤ âge de l'employé : </p>

<input type="text" name ="age" value ="<?php echo "". $age ?>" required placeholder="ex : 29" autocomplete="off" size="1" maxLength="3"> ans</input>
</br>
<p style="color:red;">¤ ancienneté : </p>

<input type="text" name ="anciennete" value ="<?php echo $anciennete ?>"  required placeholder="ex : 2023-02-15" autocomplete="off" size="6" maxLength="10"> </p>

<p style="color:red;">¤ type de contrat : </p>

<?php
$liste = array("CDD", "CDI", "Alternance", "Stage", "pas de contrat" );?>

<SELECT name="contrat" value="" size="1">
<option value="<?php echo $contrat; ?>" selected="selected"><?php echo $contrat; ?></option>

<?php 

for($i =0; $i<count($liste);$i++){


    if($liste[$i] != $contrat){
        ?><option value="<?php echo $liste[$i]; ?>"><?php echo $liste[$i]; ?></option><?php
    }  
}

$allPoste = $bdd->prepare('SELECT * FROM poste WHERE idPoste =  ?');
$allPoste->execute(array($idPosteEmp)); 

if ($allPoste->rowCount() > 0) { 
        $allPoste = $allPoste->fetchAll();      
        
        for ($i = 0; $i < count($allPoste); $i++){
            $temp = $allPoste[$i]['nomPoste'];
        }
    }

?>

</SELECT>


<p style="color:grey;">-- poste actuel  : <?php echo $temp ?></p>
<p style="color:red;">¤ poste disponible (le poste de l'employé compris) : </p>


<SELECT name="poste"  size="1">





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

            if($idPoste == $idPosteEmp){
                ?><option value="<?php echo $final; ?>" selected="selected"><?php echo $nomPoste; ?></option><?php
            
        
            }

        }

    
for ($i = 0; $i < count($allPoste); $i++){
  
    $nomPoste = $allPoste[$i]['nomPoste'];
    $idPoste = $allPoste[$i]['idPoste'];
  

 
    //regle le problème de disparition de texte
    $final = $idPoste ." ". $nomPoste;
    if($idPoste != $idPosteEmp){

    if(in_array($idPoste, $myArrayIdPoste)){
       

 
        ?><option value="<?php echo $final; ?>" ><?php echo $nomPoste; ?></option><?php
    } else {     
   
   
       
        ?><option value="" disabled selected><?php echo $nomPoste; ?></option><?php
    }
}
  
}
    
        }
?>
</SELECT>




<p class="flex"> <a href="addPoste.php"> créer un poste ? (attention vous allez tout perdre) </a> 

<p style="color:red;">¤ ville ou commune de naissance : </p>
<input type="text" name ="villeBorn" value ="<?php echo $villeBorn ?>" required placeholder="ex : saint-Herblain" autocomplete="off">

<p style="color:red;">¤ mail : </p>
<input type="text" name ="mail" value ="<?php echo $mail ?>" required placeholder="ex : nom.prenom@gmail.com" autocomplete="off">

<p style="color:red;">¤ nom : </p>
<input type="text" name ="nom" value ="<?php echo $nom ?>" required placeholder="ex : dupont" autocomplete="off">

<p style="color:red;">¤ prénom : </p>
<input type="text" name ="prenom" value ="<?php echo $prenom ?>" required placeholder="ex : jean" autocomplete="off">

<p style="color:red;">¤ numéro de sécurité social (10 max et pas de 0) : </p>
<input type="numnber" name ="numSecu" value ="<?php echo $secu ?>" required placeholder="ex : 1111111111" autocomplete="off" maxlength="10" >




<?php $listeSexe = array("homme", "femme", "autre"); ?>

<p style="color:red;">¤ sexe: </p>
<SELECT name="sexe" size="1">
<option value="<?php echo $sexe; ?>" selected="selected"><?php echo $sexe; ?></option>

<?php 

for($i =0; $i<count($listeSexe);$i++){


    if($listeSexe[$i] != $sexe){
        ?><option value="<?php echo $listeSexe[$i]; ?>"><?php echo $listeSexe[$i]; ?></option><?php
    }  
}
?>



</SELECT>

<p style="color:red;">¤ numéro de téléphone portable (sans espace) : </p>
<input type="text" name ="numTel" value ="<?php echo $tel ?>" required placeholder="ex : 06 14 58 25 25" autocomplete="off" maxlength="10" >

</br>
</br>
</br>
<button type="submit" href="addEmployee.php" name="btn">modifier l'employé !</button>


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