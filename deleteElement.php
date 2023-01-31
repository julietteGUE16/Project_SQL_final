<?php

$bdd = new PDO('mysql:host=localhost;dbname=base_bonne_etoile;charset=utf8;', 'root', '');  

$type_of_delete = $_GET['type_of_delete'];

if($type_of_delete == 1 ){
    $var_idEmploye = $_GET['idEmploye'];
}

elseif($type_of_delete == 2){
    $var_idPoste = $_GET['idPoste'];
}

elseif($type_of_delete == 3){
    $var_idPole =$_GET['idPole'];
}
else{
    $var_idSecteur =$_GET['idSecteur'];
}

//1 = employé , 2 = poste , 3 = pole , 4 = secteur


$listeidEmp=array();
$listeidPoste=array();
$listeidPole=array();

/*echo "test = " . $type_of_delete;

echo "||||test idposte = " . $var_idPoste;

echo "||||test idEmp = " . $var_idEmploye;*/




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
        </ul>
      </div>
    </div>
    <section class="page2" id="page2">
    <div class="mainAdd2">
      <h2>SUPPRIMER UN EMPLOYÉ !</h2>
<form method="POST" action="" align="center">

<h1>données supprimées :</h1>


<?php

if($type_of_delete == 1){


  ?>

<h2>employé(s) </h2>

  <?php


  $theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idEmploye = ? ');
  $theEmploye->execute(array($var_idEmploye)); 


  if ($theEmploye->rowCount() > 0) { 
          $theEmploye = $theEmploye->fetchAll();           

      
  for ($i = 0; $i < count($theEmploye); $i++){


    echo "" . $theEmploye[$i]['nom']."  " . $theEmploye[$i]['prenom']."  " . $theEmploye[$i]['sexe']."  " . $theEmploye[$i]['age']."ans  " . 
    $theEmploye[$i]['telephone']."  " . $theEmploye[$i]['contrat'];




          }   
  }
} else if ($type_of_delete == 2) {
  //poste



  $thePoste = $bdd->prepare('SELECT * FROM poste WHERE idPoste = ? ');
  $thePoste->execute(array($var_idPoste)); 


  if ($thePoste->rowCount() > 0) { 


        ?>

        <h2> poste(s) </h2>

        <?php

          $thePoste = $thePoste->fetchAll();           

      
    for ($i = 0; $i < count($thePoste); $i++){


      echo "" . $thePoste[$i]['nomPoste']."  " . $thePoste[$i]['heuresSemaine']."h  " . $thePoste[$i]['salaire']."€  ";




    }   



    $theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idPoste = ? ');
    //le id poste unique à chaque employé permet de recupérer plus facilement l'employé
    $theEmploye->execute(array($var_idPoste));
   
    
    


  if ($theEmploye->rowCount() > 0) { 

      ?>

      <h2> employé(s) </h2>

      <?php


          $theEmploye = $theEmploye->fetchAll();           

      
  for ($i = 0; $i < count($theEmploye); $i++){

   
    array_push($listeidEmp, $theEmploye[$i]['idEmploye']);

    echo "" . $theEmploye[$i]['nom']."  " . $theEmploye[$i]['prenom']."  " . $theEmploye[$i]['sexe']."  " . $theEmploye[$i]['age']."ans  " . 
    $theEmploye[$i]['telephone']."  " . $theEmploye[$i]['contrat'];




          }   
  }

  


  }
 // echo "||||taille = ". count($listeidEmp)."     |||||---";


  


}

else if ($type_of_delete == 3) {

  //pole
  $thePole = $bdd->prepare('SELECT * FROM pole WHERE idPole = ? ');
  $thePole->execute(array($var_idPole)); 


  if ($thePole->rowCount() > 0) { 


        ?>

        <h2> pole(s) </h2>

        <?php

          $thePole = $thePole->fetchAll();           

      
    for ($i = 0; $i < count($thePole); $i++){


      echo "" . $thePole[$i]['nomPole']." : " . $thePole[$i]['description'];

      }



      $thePoste = $bdd->prepare('SELECT * FROM poste WHERE idPole = ? ');
      $thePoste->execute(array($var_idPole)); 
    
    
      if ($thePoste->rowCount() > 0) { 
    
    
            ?>
    
            <h2> poste(s) </h2>
    
            <?php
    
              $thePoste = $thePoste->fetchAll();           
    
          
        for ($i = 0; $i < count($thePoste); $i++){

            array_push($listeidPoste, $thePoste[$i]['idPoste']);
    
    
          echo "" . $thePoste[$i]['nomPoste']."  " . $thePoste[$i]['heuresSemaine']."h  " . $thePoste[$i]['salaire']."€  </br></br>";
    
    
    
    
        }  

        ?>

        <h2> employé(s) </h2>

        <?php

        for ($j = 0; $j < count($listeidPoste); $j++){
                
            $theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idPoste = ? ');
            //le id poste unique à chaque employé permet de recupérer plus facilement l'employé
            $theEmploye->execute(array($listeidPoste[$j]));
          
            
            


          if ($theEmploye->rowCount() > 0) { 

           


                  $theEmploye = $theEmploye->fetchAll();           

              
          for ($i = 0; $i < count($theEmploye); $i++){

          
            array_push($listeidEmp, $theEmploye[$i]['idEmploye']);

            echo "" . $theEmploye[$i]['nom']."  " . $theEmploye[$i]['prenom']."  " . $theEmploye[$i]['sexe']."  " . $theEmploye[$i]['age']."ans  " . 
            $theEmploye[$i]['telephone']."  " . $theEmploye[$i]['contrat'] . "</br></br>";




                  }   


                }
      }


    }  

  }

  
} else {

  //secteur


  $theSecteur = $bdd->prepare('SELECT * FROM secteur WHERE idSecteur = ? ');
  $theSecteur->execute(array($var_idSecteur)); 


  if ($theSecteur->rowCount() > 0) { 


        ?>

        <h2> secteur(s) </h2>

        <?php

          $theSecteur = $theSecteur->fetchAll();           

      
    for ($i = 0; $i < count($theSecteur); $i++){


      echo "" . $theSecteur[$i]['activitePrincipale']." : " . $theSecteur[$i]['ville'];

      }




  $thePole = $bdd->prepare('SELECT * FROM pole WHERE idSecteur = ? ');
  $thePole->execute(array($var_idSecteur)); 


  if ($thePole->rowCount() > 0) { 


        ?>

        <h2> pole(s) </h2>

        <?php

          $thePole = $thePole->fetchAll();           

      
    for ($i = 0; $i < count($thePole); $i++){

      
      array_push($listeidPole, $thePole[$i]['idPole']);
      echo "" . $thePole[$i]['nomPole']." : " . $thePole[$i]['description']."</br></br>";

      }

      ?>

      <h2> poste(s) </h2>

        <?php

        for ($k = 0; $k < count($listeidPole); $k++){



      $thePoste = $bdd->prepare('SELECT * FROM poste WHERE idPole = ? ');
      $thePoste->execute(array($listeidPole[$k])); 
    
    
      if ($thePoste->rowCount() > 0) { 
    
    
    
              $thePoste = $thePoste->fetchAll();           
    
          
        for ($i = 0; $i < count($thePoste); $i++){

            array_push($listeidPoste, $thePoste[$i]['idPoste']);
    
    
          echo "" . $thePoste[$i]['nomPoste']."  " . $thePoste[$i]['heuresSemaine']."h  " . $thePoste[$i]['salaire']."€  </br></br>";
    
    
    

        }
      }

      }  

        ?>

        <h2> employé(s) </h2>

        <?php

        for ($j = 0; $j < count($listeidPoste); $j++){
                
            $theEmploye = $bdd->prepare('SELECT * FROM employe WHERE idPoste = ? ');
            //le id poste unique à chaque employé permet de recupérer plus facilement l'employé
            $theEmploye->execute(array($listeidPoste[$j]));
          
            
            


          if ($theEmploye->rowCount() > 0) { 

           


                  $theEmploye = $theEmploye->fetchAll();           

              
          for ($i = 0; $i < count($theEmploye); $i++){

          
            array_push($listeidEmp, $theEmploye[$i]['idEmploye']);

            echo "" . $theEmploye[$i]['nom']."  " . $theEmploye[$i]['prenom']."  " . $theEmploye[$i]['sexe']."  " . $theEmploye[$i]['age']."ans  " . 
            $theEmploye[$i]['telephone']."  " . $theEmploye[$i]['contrat'] . "</br></br>";




                  }   


                }
      


    }  
  }

  }

}

  //------------------------------------------------------------------//
 //------------------------------BOUTON------------------------------//
//------------------------------------------------------------------//

//bouton placé ici pour faire fonctionner l'array listeidEMp pour récupérer les employés :)
if(isset($_POST['btn'])){  
    
  if($type_of_delete == 1){
        $deleteEmploye = $bdd->prepare('DELETE FROM employe WHERE idEmploye = ?');
        $deleteEmploye->execute(array($var_idEmploye));    

  }else if($type_of_delete == 2){

    

    $deletePoste = $bdd->prepare('DELETE FROM poste WHERE idPoste = ?');
    $deletePoste->execute(array($var_idPoste));    
   

    if( count($listeidEmp) > 0){
      $deleteEmploye = $bdd->prepare('DELETE FROM employe WHERE idEmploye = ?');
      $deleteEmploye->execute(array($listeidEmp[0])); 
     

    }


    

    //poste


  }else if($type_of_delete == 3){

        //pole


    $deletePole = $bdd->prepare('DELETE FROM pole WHERE idPole = ?');
    $deletePole->execute(array($var_idPole)); 
   

    if( count($listeidPoste) > 0){
      for ($i = 0; $i < count($listeidPoste); $i++){
        $deletePoste = $bdd->prepare('DELETE FROM poste WHERE idPoste = ?');
        $deletePoste->execute(array($listeidPoste[$i]));   
      }
     

    }


    if( count($listeidEmp) > 0){
      for ($i = 0; $i < count($listeidEmp); $i++){
      $deleteEmploye = $bdd->prepare('DELETE FROM employe WHERE idEmploye = ?');
      $deleteEmploye->execute(array($listeidEmp[$i])); 
      }
     

    }




  }else {


    //secteur
    $deleteSecteur = $bdd->prepare('DELETE FROM secteur WHERE idSecteur = ?');
    $deleteSecteur->execute(array($var_idSecteur)); 

    if( count($listeidPole) > 0){
      for ($i = 0; $i < count($listeidPole); $i++){
    $deletePole = $bdd->prepare('DELETE FROM pole WHERE idPole = ?');
    $deletePole->execute(array($listeidPole[$i])); 
      }
    }
   

    if( count($listeidPoste) > 0){
      for ($i = 0; $i < count($listeidPoste); $i++){
        $deletePoste = $bdd->prepare('DELETE FROM poste WHERE idPoste = ?');
        $deletePoste->execute(array($listeidPoste[$i]));   
      }
     

    }


    if( count($listeidEmp) > 0){
      for ($i = 0; $i < count($listeidEmp); $i++){
      $deleteEmploye = $bdd->prepare('DELETE FROM employe WHERE idEmploye = ?');
      $deleteEmploye->execute(array($listeidEmp[$i])); 
      }
     

    }


  }
   
      header('Location:home.php');

      }







?>


<button type="submit" href="addSecteur.php" name="btn">comfirmer !</button>

    </div>
</form>
</html>