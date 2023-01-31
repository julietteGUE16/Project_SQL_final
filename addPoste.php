<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;','root', ''); //on créer notre objet PDO pour pouvoir exécuter nos requetes, host --> hebergeur


if(isset($_POST['btn'])){  
    
    if(!empty($_POST['poste']) AND !empty($_POST['salaire'])AND !empty($_POST['heure'])
    AND !empty($_POST['pole'])){          

            
        $poste = $_POST['poste'];
        $salaire = $_POST['salaire'];
        $pole = $_POST['pole'];
        $heure = $_POST['heure'];
        $insertPoste = $bdd->prepare('INSERT INTO `poste` (idPole,nomPoste,salaire,heuresSemaine) VALUES(?,?,?,?)');
        $resul = $insertPoste->execute(array($pole,$poste,$salaire,$heure));      
        header('Location:main.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
  
    }

}


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
          <li><a href="/project_sql_final/postes.php">POSTES</a></li>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
      <h2>CRÉER UN POSTE !</h2>
<form method="POST" action="" align="center">
<div class="mainAdd2">
<div class="together">
<p>nom poste : </p>
<input type="text" name ="poste" required placeholder="ex : développeur web  " size = "25" autocomplete="off">
</div>
<div class="together">
<p>salaire par an: </p>
<input type="text" name ="salaire" required placeholder="ex : 29 000" autocomplete="off" size="10" maxLength="15"> €</input>
</div>
<div class="together">
<p>heures / semaine </p>
<input type="text" name ="heure" required placeholder="ex : 35  " size = "5" maxLength="3" autocomplete="off"> h</input>
</div>
<div class="together">
<p>pôle : </p>
<SELECT name="pole">
<option value="" disabled selected>choix :</option>
</div>
<div class="ajoutposte">
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
</div>
</div>
<button type="submit" href="addPoste.php" name="btn">Ajouter poste !</button>


</form>
    </section>
  </body>
</html>