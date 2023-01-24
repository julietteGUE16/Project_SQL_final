<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;','root', ''); //on créer notre objet PDO pour pouvoir exécuter nos requetes, host --> hebergeur
?>

<!DOCTYPE html>
  <head>
    <title>M'AIDECINE</title>
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
          <li><a href="#main">Entreprise</a></li>
          <li><a href="#page2">Employés</a></li>
          <li><a href="#page3">Poles</a></li>
          <li><a href="#page4">Secteurs</a></li>
        </ul>
      </div>
    </div>
    <section class="main" id="main">
      <section class="page1" id="page1">
        <div class="intro">
          <h1>Bienvenu dans la base de données<br/><span>BONNE ÉTOILE</span><br/>Menu</h1>
          <p class="text">
            Sur cette application, tu trouveras toutes les informations conçernant le personnel de l'entreprise !
        </p>
        <div class="infoEntreprise">
            <div class="bold">Siège social : </div>
            <?php
            $recupSiege = $bdd->prepare('SELECT * FROM entreprise');
            $recupSiege->execute();
            $fetch = $recupSiege->fetchAll();
            echo $fetch[0]['localisationSiegeSocial'];
            ?>
            <div class="bold">Le mail : </div><?php echo $fetch[0]['mailEntreprise']; ?>
</div>
        </div>
        <div>
            <img class = "photopendu" src="https://zupimages.net/up/23/04/2386.png" />
        </div>
      </section>
    </section>
    <section class="page2" id="page2">
      <h2>EMPLOYÉS</h2>
      <p>Registre des employés actuellement en fonction dans l'entreprise</p>
      <div class="bla">
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
    </section>
    <section class="page3" id="page3">
      <h2>POLES</h2>
      <p>blabla</p>
      <br/>
    </section>
    <section class="page4" id= "page4">
      <h2>SECTEURS</h2>
      <p>Tcbejzb<br/>
  </body>
</html>