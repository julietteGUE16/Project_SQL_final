<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  



//var contexte employe qu'on a envoyé depuis la page main/home:

$var_idEmploye = $_GET['idEmploye'];

$theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idEmploye = ? ');
$theEmploye->execute(array($var_idEmploye)); 


if ($theEmploye->rowCount() > 0) { 
        $theEmploye = $theEmploye->fetchAll();           

    
for ($i = 0; $i < count($theEmploye); $i++){


     $idPosteEmp =  $theEmploye[$i]['idPoste'];
    $anciennete  = $theEmploye[$i]['anciennete'];
    $adr = $theEmploye[$i]['adressePostale'];
    $age = $theEmploye[$i]['age'];
    $villeBorn = $theEmploye[$i]['lieuNaissance'];
    $mail = $theEmploye[$i]['mail'];
    $nom = $theEmploye[$i]['nom'];
    $prenom = $theEmploye[$i]['prenom'];
    $secu = $theEmploye[$i]['numeroSecuriteSociale'];
    $tel = $theEmploye[$i]['telephone'];
    $sexe = $theEmploye[$i]['sexe'];
    $contrat = $theEmploye[$i]['contrat'];




        }   
}


   


if(isset($_POST['btn'])){  
    
      if(!empty($_POST['adresse']) AND !empty($_POST['age'])AND !empty($_POST['anciennete']) AND !empty($_POST['villeBorn'])
       AND !empty($_POST['mail']) AND !empty($_POST['nom']) AND !empty($_POST['prenom']) 
       AND !empty($_POST['numSecu'])AND !empty($_POST['numTel'])AND !empty($_POST['sexe'])
       AND !empty($_POST['contrat'])  AND !empty($_POST['poste'])){   

     

        //info $_POST['poste'] coupe au niveau des espaces donc précéddement on à mis en tête du texte l'id donc $_POST['poste'] nous donne que l'id du poste
        $idPoste2 =  $_POST['poste'];
        $anciennete2  = $_POST['anciennete'];
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

    
      


          $updateEmploye = $bdd->prepare("UPDATE employe SET nom ='$nom2', prenom ='$prenom2', idPoste='$idPoste2' , adressePostale='$adr2' , anciennete='$anciennete2' , 
          age='$age2' , lieuNaissance='$villeBorn2' , mail='$mail2' , numeroSecuriteSociale='$secu2' , telephone='$tel2' , sexe='$sexe2' , contrat='$contrat2'  WHERE idEmploye = ?");
          $resul = $updateEmploye->execute(array($var_idEmploye));      
          

         header('Location:main.php');
        

      } else {
       
       
       
       
       
       
         echo "<script>alert('veuillez compléter tous les champs !')</script>";
       
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


<p style="color:grey;">-- contrat actuel  : <?php echo $contrat ?></p>
<p style="color:red;">¤ type de contrat : </p>


<?php
$liste = array("CDD", "CDI", "Alternance", "Stage", "pas de contrat" );?>

<SELECT name="contrat" value="" size="1">
<option  value="<?php echo $contrat; ?>" selected="selected"><?php echo $contrat; ?></option>

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




<SELECT name="poste" value=""  size="1">

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
   
    if($idPoste != $idPosteEmp){

    if(in_array($idPoste, $myArrayIdPoste)){
       

 
        ?><option value="<?php echo $idPoste; ?>" ><?php echo $nomPoste; ?></option><?php
    } else {     
   
   
       
        ?><option value="" disabled selected><?php echo $nomPoste; ?></option><?php
    }
}
  
}
for ($i = 0; $i < count($allPoste); $i++){
  
    $nomPoste = $allPoste[$i]['nomPoste'];
    $idPoste = $allPoste[$i]['idPoste'];

    if($idPoste == $idPosteEmp){
        ?><option selected value="<?php echo $idPoste; ?>" ><?php echo $nomPoste; ?></option><?php
    

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

<p style="color:red;">¤ 9 premier numéro de sécurité social (9 max et pas de 0) : </p>
<input type="texte" name ="numSecu" value ="<?php echo $secu ?>" required placeholder="ex : 1111111111" autocomplete="off" maxlength="9" >




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
<p >0
<input type="text" name ="numTel" value ="<?php echo $tel ?>" required placeholder="ex : 06 14 58 25 25" autocomplete="off" maxlength="9" ></p>

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