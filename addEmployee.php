<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;','root', ''); //on créer notre objet PDO pour pouvoir exécuter nos requetes, host --> hebergeur
?>

<!DOCTYPE html>
  <head>
    <title>Bonne étoile</title>
    <link type="image/png" href="https://zupimages.net/up/22/10/4cuf.png" />
    <link rel="stylesheet" href="home.css" />
    <link href="https://fonts.googleapis.com/css2?family=Amatic+SC&family=Encode+Sans:wght@100&display=swap" rel="stylesheet">
  </head>
  
  <body>
    <div class="navbar">
      <div class="icon">
        <img class="logomed" src="https://zupimages.net/up/23/04/1zcu.png" />
      </div>
      <div class="menu">
        <ul>
          <li><a href="/project_sql_final/home.php">MENU</a></li>
          <li><a href="/project_sql_final/employes.php">EMPLOYÉS</a></li>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
      <h2>CRÉER UN EMPLOYÉ !</h2>
      <?php if(isset($_POST['btn'])){  
    
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
        $resul = $insertEmploye->execute(array($idPoste,$prenom,$nom,$age,$sexe,$mail,$tel,$secu,$contrat,$anciennete,$adr,$villeBorn));      
        
       
        
      

        header('Location:home.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
     
    }

}

?>
<html>

<div class="mainAdd">
<div class="gauche">
<form method="POST" action="" align="center">

<div class="together"><p>adresse postale : </p>
<input type="text" name ="adresse" required placeholder="ex : 40 rue du général de gaulle 44000 nantes  " size = "40" autocomplete="off">
</div>

<div class="together">
<p>âge : </p>
<input type="text" name ="age" required placeholder="ex : 29" autocomplete="off" size="1" maxLength="3">
<p>ans</p>
</div>
<br>
<p>ANCIENNETE : </p>
<p> year : 
<input type="text" name ="year" required placeholder="ex : 2023" autocomplete="off" size="4" maxLength="4"> </p>
<p> month :
<input type="text" name ="month" required placeholder="ex : 01" autocomplete="off" size="2" maxLength="2"> </p>
<p> day :
<input type="text" name ="day" required placeholder="ex : 15" autocomplete="off" size="2" maxLength="2"> </p>
<br>
<div class="together">
<p>type de contrat : </p>
<SELECT name="contrat" size="1">
<option value="" disabled selected>choix :</option>
<option value="CDD">CDD</option>
<option value="CDI">CDI</option>
<option value="Alternance">Alternance</option>
<option value="Stage">Stage</option>
</SELECT>
</div>
<div class="together">
<p>poste disponible : </p>
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
    </div>


<p class="flex"> <a href="addPoste.php"> créer un poste ? (attention vous allez tout perdre) </a> 

</div>
<div>
<div class="together">
<p>ville de naissance : </p>
<input type="text" name ="villeBorn" required placeholder="ex : saint-Herblain" autocomplete="off">
    </div>
<div class="together">
<p>mail : </p>
<input type="text" name ="mail" required placeholder="ex : nom.prenom@gmail.com" autocomplete="off">
    </div>
<div class="together">
<p>nom : </p>
<input type="text" name ="nom" required placeholder="ex : dupont" autocomplete="off">
    </div>
<div class="together">
<p>prénom : </p>
<input type="text" name ="prenom" required placeholder="ex : jean" autocomplete="off">
</div>
<div class="together">
<p>numéro de sécurité social (9 max et pas de 0) : </p>
<input type="text" name ="numSecu" required placeholder="ex : 111111111" autocomplete="off" maxlength="9" >
</div>
<div class="together">
<p>sexe: </p>
<SELECT name="sexe" size="1">
<option value="" disabled selected>choix :</option>
<option value="homme">homme</option>
<option value="femme">femme</option>
<option value="autre">autre</option>
</SELECT>
</div>
<div class="together">
<p>numéro de téléphone portable (sans espace ni le 0) : </p>
<input type="text" name ="numTel" required placeholder="ex : 06 14 58 25 25" autocomplete="off" maxlength="9" >
</div>

<button type="submit" href="addEmployee.php" name="btn">Ajouter l'employé !</button>
    </div>

</form>
<main>
    </section>
  </body>
</html>