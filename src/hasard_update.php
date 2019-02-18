<?php
//page appelé par une tache cron tous les soirs
//Appel possible uniquement par le serveur

//from public url
if( $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'] ){
    die('Accès Interdit!');
}

//from localhost
if( $_SERVER['REMOTE_ADDR'] != "127.0.0.1" ){
    die('Accès Interdit!');
}

//together
if( $_SERVER['REMOTE_ADDR'] != $_SERVER['SERVER_ADDR'] || $_SERVER['REMOTE_ADDR'] != "127.0.0.1" ){
    die('Accès Interdit!');
}


//Connexion bdd
include_once 'connexion_bdd.php';

$verifInternesDispo = $bdd->prepare("SELECT
  (SELECT SUM(nbrFilleuls - Filleul) FROM internes i WHERE spe=:spe)
  -
  (SELECT COUNT(*) FROM externes WHERE ID_interne = -1)
") ;

//45 spé on les parcours une par une pour vérifier si il reste des places
for ($i=1; $i <= 45 ; $i++) {

  $verifInternesDispo = $bdd->prepare("SELECT
    (SELECT SUM(nbrFilleuls - Filleul) FROM internes i WHERE spe=:spe)
    -
    (SELECT COUNT(*) FROM externes WHERE ID_interne = -1)
  ") ;
  $verifInternesDispo->bindParam('spe', $i, PDO:: PARAM_INT);
  $verifInternesDispo->execute();
  $result = $verifInternesDispo->fetch();
  $verifInternesDispo->closeCursor();

  //attribution au hasard
  if( empty($result[0]) ) {

    //on récupère les internes de la spé encore dispo
    $getInternes = $bdd->prepare("SELECT * FROM internes WHERE spe=:spe AND nbrFilleuls > Filleul");
    $getInternes->bindParam('spe', $i, PDO:: PARAM_INT);
    $getInternes->execute();

    //on récupère les externes qui seront attribué aux hasard:
    $getExternes = $bdd->prepare("SELECT * FROM externes WHERE spe=:spe AND ID_interne = -1");
    $getExternes->bindParam('spe', $i, PDO:: PARAM_INT);
    $getExternes->execute();
    $donneesExterne = $getExternes->fetchAll();
    $getExternes->closeCursor();

    $j=0;
    //on affiche les internes un par un
    while ($donneesInterne = $getInternes->fetch()){

      for($k = $donneesInterne['Filleul'] ; $donneesInterne['nbrFilleuls'] > $k ; $k++) {

        $reqI = $bdd->prepare('UPDATE internes SET Filleul = :filleul WHERE id = :id');
        $reqI->execute(array( 'filleul' => ($k+1), 'id'=> $donneesInterne['id'] ));
        $reqI->closeCursor();

        $reqE = $bdd->prepare('UPDATE externes SET ID_interne = :ID_interne WHERE id = :id');
        $reqE->execute( array( 'ID_interne' => $donneesInterne['id'] , 'id' => $donneesExterne[$j]['id'] ) );

        $j = ++$j;

      }

    }


  }


}
