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
          <li><a href="/project_sql_final/addEmployee.php">AJOUTER UN EMPLOYÉ</a></li>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
      <h2>EMPLOYÉS</h2>
      <p>Registre des employés actuellement en fonction dans l'entreprise</p>
      <div class="ctr">
      <div class="bla2">
        <?php 
        $recupCount = $bdd->prepare('SELECT COUNT(*) FROM employe');
        $recupCount->execute();
        $fetchC = $recupCount->fetch();
        $_SESSION['nombremploye'] = $fetchC[0];

        $recupEmp = $bdd->prepare('SELECT * FROM employe');
        $recupEmp->execute();
        $fetch = $recupEmp->fetchAll();?>
          <?php
            for($i=0; $i < $_SESSION['nombremploye']; $i++){ 
              ?>
              <li>
              <div class="box">
              <div class="infoP"><?php echo $fetch[$i]['prenom'];?></div>
              <div class= "infoP"><?php echo $fetch[$i]['nom']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['age']; ?> ans</div>
              <div class= "info"><?php echo $fetch[$i]['sexe']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['mail']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['telephone']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['numeroSecuriteSociale']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['contrat']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['anciennete']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['adressePostale']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['lieuNaissance']; ?></div>
              </div></br>
              <?php
            }?>
            </div>
          </div>
          </li>
    </section>
  </body>
</html>