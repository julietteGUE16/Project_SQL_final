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
          <li><a href="/project_sql_final/poles.php">POLES</a></li>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
    <div class="mainAdd2">
      <h2>CRÉER UN POLE !</h2>
<form method="POST" action="" align="center">
<div class="together">
<p>nom pole : </p>
<input type="text" name ="pole" required placeholder="ex : pole informatique  " size = "25" autocomplete="off">
</div>
<div class="together">
<p>description: </p>
<input type="text" name ="description" required placeholder="ex : gestion des bases de données..." autocomplete="off" size="40" maxLength="100"> 
</div>
<div class="together">
<p>secteur : </p>
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

</div>

<button type="submit" href="addPole.php" name="btn">Ajouter pole !</button>


</form>

</div>
</html>