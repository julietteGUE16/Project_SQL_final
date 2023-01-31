<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  





if(isset($_POST['btn'])){  
    
    if(!empty($_POST['ville']) AND !empty($_POST['activite'])){          

            
     
        $ville = $_POST['ville'];
        $activite = $_POST['activite'];
 
        $insertSecteur = $bdd->prepare('INSERT INTO `secteur` (ville,activitePrincipale) VALUES(?,?)');
        $resul = $insertSecteur->execute(array($ville,$activite));      
        header('Location:home.php');
      

    } else {
     
      echo "<script>alert('veuillez compléter tous les champs !')</script>";
  
    }

}


?>




<!DOCTYPE html>
<html>
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
          <li><a href="/project_sql_final/secteurs.php">SECTEURS</a></li>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
      <h2>CRÉER UN SECTEUR !</h2>
<form method="POST" action="" align="center">
<div class="mainAdd2">
<div class="together">
<p>ville : </p>
<input type="text" name ="ville" required placeholder="ex : Nantes  " size = "25" autocomplete="off">
</div>
<div class="together">
<p>activité principale : </p>
<input type="text" name ="activite" required placeholder="ex : centre informatique" autocomplete="off" size="40" maxLength="100"> 
</div>

<div class="together">
<button type="submit" href="addSecteur.php" name="btn">Ajouter secteur !</button>
</div>

</form>

</div>
</html>