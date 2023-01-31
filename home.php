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
          <li><a href="#main">Entreprise</a></li>
          <li><a href="#page2">Employés</a></li>
          <li><a href="#page3">Postes</a></li>
          <li><a href="#page4">Poles</a></li>
          <li><a href="#page5">Secteurs</a></li>
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
            if($_SESSION['nombremploye'] > 5){$_SESSION['nombremploye'] = 5;}
            for($i=0; $i < $_SESSION['nombremploye']; $i++){ 
              ?>
              <div class="box">
              <div class="infoP"><?php echo $fetch[$i]['prenom'];?></div>
              <div class= "infoP"><?php echo $fetch[$i]['nom']; ?></div>
              <div class= "infoPD"><?php
              $getPoste = $bdd->prepare('SELECT * FROM poste WHERE idPoste = ?');
              $getPoste->execute(array($fetch[$i]['idPoste'])); 
                  $getPoste = $getPoste->fetchAll(); 
                             echo "" . $getPoste[0]['nomPoste']; 
              ?></div>
              <div class= "info"><?php echo $fetch[$i]['age']; ?> ans</div>
              <div class= "info"><?php echo $fetch[$i]['sexe']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['mail']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['telephone']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['numeroSecuriteSociale']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['contrat']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['anciennete']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['adressePostale']; ?></div>
              <div class= "info"><?php echo $fetch[$i]['lieuNaissance']; ?></div>
              <div class="together">
              <form method="get" action="updateEmploye.php">
              <input type="hidden" name="idEmploye" value=" <?php echo "". $fetch[$i]['idEmploye'] ?>" >
              <input type="submit" value ="edit employe">
            </form>
              <form method="get" action="deleteElement.php">
              <input type="hidden" name="idEmploye" value=" <?php echo "". $fetch[$i]['idEmploye'] ?>" >
              <input type="hidden" name="type_of_delete" value=" <?php echo "". 1 ?>" >
              <input type="submit" value ="delete employe">  
              </form>
            </div>
              </div></br>
              <?php
            }?><a href="/project_sql_final/employes.php"><div class="boxend">+</div></a>
            </div>
    </section>
    <section class="page3" id="page3">
      <h2>POSTES</h2>
      <p>Registre des postes de l'entreprise</p>
      <div class="bla">
        <?php 
        $recupCount = $bdd->prepare('SELECT COUNT(*) FROM poste');
        $recupCount->execute();
        $fetchC = $recupCount->fetch();
        $_SESSION['nombremploye'] = $fetchC[0];

        $recupEmp = $bdd->prepare('SELECT * FROM poste');
        $recupEmp->execute();
        $fetch = $recupEmp->fetchAll();?>
          <?php
            if($_SESSION['nombremploye'] > 5){$_SESSION['nombremploye'] = 5;}
            for($i=0; $i < $_SESSION['nombremploye']; $i++){ 
              ?>
              <div class="box">
              <div class="infoP"><?php echo $fetch[$i]['nomPoste'];?></div>
              <div class= "infoP"><?php echo $fetch[$i]['salaire']; ?> euros </div>
              <div class= "infoPD"><?php
              $getPoste = $bdd->prepare('SELECT * FROM pole WHERE idPole = ?');
              $getPoste->execute(array($fetch[$i]['idPole'])); 
                  $getPoste = $getPoste->fetchAll(); 
                             echo "" . $getPoste[0]['nomPole']; 
              ?></div>
              <div class= "info"><?php echo $fetch[$i]['heuresSemaine']; ?> heures</div>
              <div class="together">
              <form method="get" action="deleteElement.php">
              <input type="hidden" name="idPoste" value=" <?php echo "". $fetch[$i]['idPoste'] ?>" >
              <input type="hidden" name="type_of_delete" value=" <?php echo "". 2 ?>" >
              <input type="submit" value ="delete poste">  
              </form>
            </div>
              </div></br>
              <?php
            }?><a href="/project_sql_final/postes.php"><div class="boxend">+</div></a>
            </div>
    </section>
    <section class="page4" id="page4">
    <h2>POLES</h2>
      <p>Registre des poles de l'entreprise</p>
      <div class="bla">
        <?php 
        $recupCount = $bdd->prepare('SELECT COUNT(*) FROM pole');
        $recupCount->execute();
        $fetchC = $recupCount->fetch();
        $_SESSION['nombrepole'] = $fetchC[0];

        $recupEmp = $bdd->prepare('SELECT * FROM pole');
        $recupEmp->execute();
        $fetch = $recupEmp->fetchAll();?>
          <?php
            if($_SESSION['nombrepole'] > 5){$_SESSION['nombrepole'] = 5;}
            for($i=0; $i < $_SESSION['nombrepole']; $i++){ 
              ?>
              <div class="box">
              <div class="infoP"><?php echo $fetch[$i]['nomPole'];?></div>
              <div class= "infoPD"><?php
              $getPoste = $bdd->prepare('SELECT * FROM secteur WHERE idSecteur = ?');
              $getPoste->execute(array($fetch[$i]['idSecteur'])); 
                  $getPoste = $getPoste->fetchAll(); 
                             echo "" . $getPoste[0]['activitePrincipale']; 
              ?></div>
              <div class= "info"><?php echo $fetch[$i]['description']; ?></div>
              <div class="together">
              <form method="get" action="deleteElement.php">
              <input type="hidden" name="idPole" value=" <?php echo "". $fetch[$i]['idPole'] ?>" >
              <input type="hidden" name="type_of_delete" value=" <?php echo "". 3 ?>" >
              <input type="submit" value ="delete pole">  
              </form>
            </div>
              </div></br>
              <?php
            }?><a href="/project_sql_final/poles.php"><div class="boxend">+</div></a>
            </div>
    </section>
    <section class="page5" id= "page5">
    <h2>SECTEURS</h2>
      <p>Registre des secteurs de l'entreprise</p>
      <div class="bla">
        <?php 
        $recupCount = $bdd->prepare('SELECT COUNT(*) FROM secteur');
        $recupCount->execute();
        $fetchC = $recupCount->fetch();
        $_SESSION['nombresecteurs'] = $fetchC[0];

        $recupEmp = $bdd->prepare('SELECT * FROM secteur');
        $recupEmp->execute();
        $fetch = $recupEmp->fetchAll();?>
          <?php
            if($_SESSION['nombresecteurs'] > 5){$_SESSION['nombresecteurs'] = 5;}
            for($i=0; $i < $_SESSION['nombresecteurs']; $i++){ 
              ?>
              <div class="box">
              <div class="infoP"><?php echo $fetch[$i]['ville'];?></div>
              <div class= "info"><?php echo $fetch[$i]['activitePrincipale']; ?></div>
              <div class="together">
              <form method="get" action="deleteElement.php">
              <input type="hidden" name="idSecteur" value=" <?php echo "". $fetch[$i]['idSecteur'] ?>" >
              <input type="hidden" name="type_of_delete" value=" <?php echo "". 4 ?>" >
              <input type="submit" value ="delete secteur">  
              </form>
            </div>
              </div></br>
              <?php
            }?><a href="/project_sql_final/secteurs.php"><div class="boxend">+</div></a>
            </div>
  </body>
</html>