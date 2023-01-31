<?php

session_start();
$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;','root', ''); //on créer notre objet PDO pour pouvoir exécuter nos requetes, host --> hebergeur
$allemployes = $bdd->query('SELECT * FROM poste ORDER BY idPoste DESC');
if(isset($_GET['s']) AND !empty($_GET['s'])){
  $recherche = htmlspecialchars($_GET['s']);
  $allemployes = $bdd->query('SELECT * FROM poste WHERE nomPoste LIKE "%'.$recherche.'%" OR nom LIKE "%'.$recherche.'%" ORDER BY idPoste DESC');
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
          <li><a href="/project_sql_final/addPoste.php">+POSTE</a></li>
          <div class="recherche">
            <form method="GET">
            <input type="search" name="s" placeholder="Rechercher un poste" />
            <input type="submit" name="valider" value="Rechercher" />
          </form>
        </div>
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
      <h2>POSTES</h2>
      <p>Registre des POSTES dans l'entreprise</p>
      <div class="ctr">
      <div class="bla2">
        <?php 
        $recupCount = $bdd->prepare('SELECT COUNT(*) FROM poste');
        $recupCount->execute();
        $fetchC = $recupCount->fetch();
        $nombremploye = $fetchC[0];

        $recupEmp = $bdd->prepare('SELECT * FROM poste');
        $recupEmp->execute();
        $fetch = $recupEmp->fetchAll();?>
          <?php
          if($allemployes->rowcount()>0){
            while($user =$allemployes->fetchAll()){
              $fetch = $user;
            }
            $nombremploye = $allemployes->rowCount();
          }
            for($i=0; $i < $nombremploye; $i++){ 
              ?>
              <li>
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
              <input type="submit" value ="delete poste">  </form>
            </div>
              </div>
            </br>
              <?php
            }?>
            </div>
          </div>
          </li>
    </section>
  </body>
</html>