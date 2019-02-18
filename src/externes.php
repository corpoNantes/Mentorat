<?php
include_once 'connexion_bdd.php';

function convertirPriorite($P){
  switch ($P) {
    case 1:
    return 'typeContactRencontre';
    break;
    case 2:
    return 'tempsMentorat';
    break;
    case 3:
    return 'dispoNantes';
    break;
  }
}

// Récupération des données du formulaire
$nom = $_POST['name'];
$prenom = $_POST['prenom'];
$email = $_POST['email'];
$tel = $_POST['contact'];
$numeroEtudiant = $_POST['numeroEtudiant'];
$spe = $_POST['specialite'];
$dispoNantes = $_POST['dispoNantes'];
$tempsMentorat = $_POST['tempsMentorat'];
$typeContactRencontre = $_POST['typeContact'];
$Pun = $_POST['premier'];
$Pdeux = $_POST['deuxieme'];
$Ptrois = $_POST['troisieme'];

//Vérification des données envoyées: les variables issues du formulaires ne sont pas vides
if (!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($tel) AND !empty($spe) AND !empty($tempsMentorat) ) {

  //Vérification des données envoyées: transtypage = si l'utilisateur a envoyé du texte la variable de originalement de type string vaut 0 après conversion ou si nombre à virgule (float) tronquage de la partie decimale
  $spe = (int) $spe;
  $tempsMentorat = (int) $tempsMentorat;
  $tel  = (int) $tel;
  $Pun = (int) $Pun;
  $Pdeux = (int) $Pdeux;
  $Ptrois = (int) $Ptrois;

  ////Vérification des données envoyées: transtypage = si l'utilisateur a envoyé du texte la variable de originalement de type string vaut 0 après conversion (condition ternaire là pour palier au problème du formulaire qui envoie "" comme valeur au lieu de 0)
  $typeContactRencontre = ((bool)$typeContactRencontre) ? '1' : '0';
  $dispoNantes = ((bool)$dispoNantes) ? '1' : '0';

  //Vérification des données envoyées: on vérifie que l'utilisateur a bien choisi une spe parmi celle proposée, un nombre de filleuls compris entre 1 et 5, un temps investi parmis ceux proposés  et les priorités
  if (1 <= $spe AND $spe <= 45 AND 1 <= $tempsMentorat AND $tempsMentorat <= 4
  AND 1 <= $Pun AND $Pun <= 3 AND 1 <= $Pdeux AND $Pdeux <= 3 AND 1 <= $Ptrois AND $Ptrois <= 3 AND $Pun != $Pdeux AND $Pun != $Ptrois AND $Ptrois != $Pdeux) {


    //on vérifie que l'externe n'est pas déjà inscrit en se basant sur le num étudiant
    $verifDoublons = $bdd->prepare("SELECT COUNT(*) AS ExterneDejaPresent
      FROM externes
      WHERE numeroEtudiant = :numeroEtudiant");
    $verifDoublons->execute(array('numeroEtudiant' => $numeroEtudiant));
    $result = $verifDoublons->fetch();
    $verifDoublons->closeCursor();
    if( !empty($result['ExterneDejaPresent']) ) {
      $message_error = 'Vous êtes déjà inscrit au systeme de mentorat ' . htmlspecialchars($prenom);
    }


    //on vérifie qu'il reste encore des internes de dispo (le temps pour l'externe de completer le formulaire quelqu'un d'autre a pu s'inscrire et prendre la dernière place) et que le total des places en comptant les externes attribué aux hasard ne dépasse pas le total de places dispo
    $verifInternesDispo = $bdd->prepare("SELECT
      (SELECT SUM(nbrFilleuls - Filleul) FROM internes i WHERE spe=:spe)
      -
      (SELECT COUNT(*) FROM externes WHERE ID_interne = -1)
    ") ;
    $verifInternesDispo->bindParam('spe', $spe, PDO:: PARAM_INT);
    $verifInternesDispo->execute();
    $result = $verifInternesDispo->fetch();
    $verifInternesDispo->closeCursor();

    if( empty($result[0]) ) {
      $message_error = "Il n'y a plus d'internes disponibles pour cette spécialité..." ;
      $req = $bdd->prepare("UPDATE specialites SET InternesD = 0 WHERE id = :spe");
      $req->bindParam('spe', $spe, PDO:: PARAM_INT);
      $test = $req->execute();
      $req->closeCursor();
    }

    //On passe maintenant au matching
    if(empty($message_error) ){

      //on recupère les données des internes ayant encore des places et dont la spé correspond
      $reponse = $bdd->prepare("SELECT *
                              FROM internes
                              WHERE nbrFilleuls > Filleul
                              AND spe = :spe
                              ORDER BY id");
      $reponse->bindParam('spe', $spe, PDO:: PARAM_INT);
      $reponse->execute();

      //On verifie qu'il y a encore des internes dispo
      $donneesEntieres = $reponse->fetchAll();
      $reponse->closeCursor();

      $cleI = 0;
      $id_I = 0;
      $trouveI = false;
      $message = null;

      //converti le chiffre renvoyé par le formulaire en nom de la colonne de la table
      $Pa = convertirPriorite($Pun);
      $Pb = convertirPriorite($Pdeux);
      $Pc = convertirPriorite($Ptrois);

      $donneesInterneRecherche = array (
        'dispoNantes' => $dispoNantes,
        'typeContactRencontre' => $typeContactRencontre,
        'tempsMentorat' => $tempsMentorat);

      //On parcourt le tableau des internes ayant la spe choisi par l'externe à la recherche de l'interne parfait
      foreach($donneesEntieres as $cle => $element)
        {
          //Interne parfait
          if ($element[$Pa] == $donneesInterneRecherche[$Pa]
            AND $element[$Pb] == $donneesInterneRecherche[$Pb]
            AND $element[$Pc] == $donneesInterneRecherche[$Pc]
            AND !$trouveI) {
              $message = "L'interne trouvé correspond exactement à vos critères de recherche.";
              //On sauvegarde l'id de l'interne mais on ne pourra pas baser notre condition sur son existence car l'ID peut être égal à 0 si c'est la première ligne de la table, d'ou la 2eme variable
              $id_I = $element['id'];
              $cleI = $element;
              $trouveI = true;
          }

        }

        //Puis après on fait selon l'ordre des priorités


      if(!$trouveI){
        foreach($donneesEntieres as $cle => $element)
          {
              if ($element[$Pa] == $donneesInterneRecherche[$Pa]
                AND $element[$Pb] == $donneesInterneRecherche[$Pb]
                AND !$trouveI) {
                  $message = "Il n'y a pas d'interne correspondant exactement à tous vos critères. Mais un interne remplissant vos 2 premiers critères a été trouvé!";
                  $id_I = $element['id'];
                  $cleI = $element;
                  $trouveI = true;
              }
          }
        }

        if(!$trouveI){
          foreach($donneesEntieres as $cle => $element)
            {
              if ($element[$Pa] == $donneesInterneRecherche[$Pa]
                AND !$trouveI) {
                  $message = "Il n'y a pas d'interne correspondant exactement à tous vos critères. Mais un interne remplissant votre premier critère a été trouvé!";
                  $id_I = $element['id'];
                  $cleI = $element;
                  $trouveI = true;
              }
            }
        }

        if(!$trouveI){
          foreach($donneesEntieres as $cle => $element)
            {
              if ($element[$Pb] == $donneesInterneRecherche[$Pb]
                AND $element[$Pc] == $donneesInterneRecherche[$Pc]
                AND !$trouveI) {
                  $message = "Il n'y a pas d'interne correspondant exactement à tous vos critères. Mais un interne remplissant vos deuxième et troisième critères a été trouvé!";
                  $id_I = $element['id'];
                  $cleI = $element;
                  $trouveI = true;
              }
            }
        }

        if(!$trouveI){
          foreach($donneesEntieres as $cle => $element)
            {
              if ($element[$Pb] == $donneesInterneRecherche[$Pb]
                AND !$trouveI) {
                  $message = "Il n'y a pas d'interne correspondant exactement à tous vos critères. Mais un interne remplissant votre deuxieme critère a été trouvé!";
                  $id_I = $element['id'];
                  $cleI = $element;
                  $trouveI = true;
              }
            }
        }

        if(!$trouveI){
          foreach($donneesEntieres as $cle => $element)
            {
              if ($element[$Pc] == $donneesInterneRecherche[$Pc]
                AND !$trouveI) {
                  $message = "Il n'y a pas d'interne correspondant exactement à tous vos critères. Mais un interne remplissant votre troisième critère a été trouvé!";
                  $id_I = $element['id'];
                  $cleI = $element;
                  $trouveI = true;
              }
            }
        }

        if(!$trouveI) {
          $message = "Malheureusement il n'y a aucun interne correspondant à vos critères. Un interne de la spécialité vous sera attribué une fois les inscriptions closes.";
          $id_I = -1;
          $trouveI = true;
        }

        $req = $bdd->prepare("INSERT INTO externes(numeroEtudiant, nom, prenom, email, tel, spe, ID_interne, dispoNantes, tempsMentorat, typeContactRencontre)
        VALUES(:numeroEtudiant, :nom, :prenom, :email, :tel, :spe, :ID_interne, :dispoNantes, :tempsMentorat, :typeContactRencontre)");
        $req->execute(array(
            'numeroEtudiant' => strtoupper($numeroEtudiant),
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'tel' => $tel,
            'spe' => $spe,
            'ID_interne' => $id_I,
            'dispoNantes' => $dispoNantes,
            'tempsMentorat' => $tempsMentorat,
            'typeContactRencontre' => $typeContactRencontre
        ));
        $req->closeCursor();

        if($id_I != -1){
          $req = $bdd->prepare('UPDATE internes SET Filleul = :filleul WHERE id = :id_I');

          $fNbr = $cleI['Filleul'];
          $Filleul = ++$fNbr;

          $req->execute(array('filleul' => $Filleul,
                              'id_I' => $id_I
                            ));
          $req->closeCursor();
        }

    }

  }
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mentorat</title>
    <link rel="icon" type="image/png" href="img/favicon.png" />

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template -->
    <link href="css/freelancer.min.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg bg-secondary fixed-top text-uppercase" id="mainNav">
      <div class="container">
        <a class="navbar-brand js-scroll-trigger" href="index.php"><i class="fas fa-home"></i> Mentorat</a>
      </div>
    </nav>

    <!-- Header -->
    <?php if(!empty($message_error)){
      echo '<header class="masthead bg-danger text-white text-center"><div class="container"><h1 class="text-uppercase mb-0">' .
      $message_error .
      '</h1></div></header>';

    }
    else {
      echo '<header class="masthead bg-primary text-white text-center"><div class="container"><h1 class="text-uppercase mb-0">' . $message . '</h1><hr class="star-light"></div></header>';
    }
    if(isset($id_I)){?>


    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Et maintenant?</h2>
        <hr class="star-dark mb-5">
          <p class="lead"><?php if($id_I != -1) echo 'Ton interne est ' . htmlspecialchars($cleI['prenom']) . ' ' .  strtoupper(htmlspecialchars($cleI['nom'])); else echo 'Tu auras le nom de ton interne une fois les inscriptions closes! ;)'; if(!empty($cleI['commentaire'])) echo '<br>Commentaire: ' . htmlspecialchars($cleI['commentaire']); ?></p>
      </div>
    </section>

  <?php }?>
    <footer class="footer text-center">
      <div class="container">
        <div class="row">
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Nous situer</h4>
            <p class="lead mb-0">1 Rue Gaston Veil, 44000 Nantes
              <br>Corporation Nantaise des Etudiants en Médecine</p>
          </div>
          <div class="col-md-4 mb-5 mb-lg-0">
            <h4 class="text-uppercase mb-4">Sur le Web</h4>
            <ul class="list-inline mb-0">
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.facebook.com/CNEMedecine">
                  <i class="fab fa-fw fa-facebook-f"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://twitter.com/cnemedecine?lang=fr">
                  <i class="fab fa-fw fa-twitter"></i>
                </a>
              </li>
              <li class="list-inline-item">
                <a class="btn btn-outline-light btn-social text-center rounded-circle" href="https://www.instagram.com/cnemedecine/?hl=fr">
                  <i class="fab fa-fw fa-instagram"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="col-md-4">
            <h4 class="text-uppercase mb-4">Qui sommes nous?</h4>
            <p class="lead mb-0">La CNEM est une association loi 1901 existant depuis 1993 à destination des étudiants en médecine.
              <a href="https://www.la-cnem.org/">En savoir plus</a>.</p>
          </div>
        </div>
      </div>
    </footer>

    <div class="copyright py-4 text-center text-white">
      <div class="container">
        <small>Copyright &copy; CNEM - Donatien MICHEL</small>
      </div>
    </div>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-to-top d-lg-none position-fixed ">
      <a class="js-scroll-trigger d-block text-center text-white rounded" href="#page-top">
        <i class="fa fa-chevron-up"></i>
      </a>
    </div>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/freelancer.min.js"></script>

  </body>

</html>
