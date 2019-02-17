<?php
//Connexion à la base de données
try {
    $bdd = new PDO('mysql:host=localhost;dbname=mentorat;charset=utf8', 'root', '', array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ));
}
catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

// Récupération des données du formulaire

$nom = $_POST['name1'];
$prenom = $_POST['prenom1'];
$email = $_POST['email1'];
$tel = $_POST['contact1'];
$spe = $_POST['specialite1'];
$nbrFilleuls = $_POST['nbrFilleulsRange'];
$commentaire = $_POST['commentaire1'];
$dispoNantes = $_POST['dispoNantes1'];
$tempsMentorat = $_POST['tempsMentorat1'];
$typeContactRencontre = $_POST['typeContact1'];
$numeroEtudiant = $_POST['numeroEtudiant1'];
$message = '';

// Vérification des données envoyées: transtypage = si l'utilisateur a envoyé du texte la variable de originalement de type string vaut 0 après conversion ou si nombre à virgule (float) tronquage de la partie decimale

$spe = (int)$spe;
$nbrFilleuls = (int)$nbrFilleuls;
$tempsMentorat = (int)$tempsMentorat;


// Vérification des données envoyées: transtypage = si l'utilisateur a envoyé du texte la variable de originalement de type string vaut 0 après conversion (condition là pour palier au problème du formulaire qui envoie null comme valeur au lieu de 0)

$typeContactRencontre = ((bool)$typeContactRencontre) ? '1' : '0';
$dispoNantes = ((bool)$dispoNantes) ? '1' : '0';

// Vérification des données envoyées: les variables issues du formulaires ne sont pas vides

if (!empty($nom) AND !empty($prenom) AND !empty($email) AND !empty($tel) AND !empty($numeroEtudiant) AND !empty($spe) AND !empty($nbrFilleuls) AND !empty($tempsMentorat)) {

  // Vérification qu'il ne s'agit pas d'un doublon

  $req = $bdd->prepare("SELECT id FROM internes WHERE numeroEtudiant = :numeroEtudiant");

  $req->execute(array('numeroEtudiant' => $numeroEtudiant));
  $rep = $req->fetch();
  $req->closeCursor();
  if (!empty($rep)) {
    $message = 'Vous êtes déjà inscrit au systeme de mentorat ' . htmlspecialchars($prenom);
  }
  else {

    // Vérification des données envoyées: on vérifie que l'utilisateur a bien choisi une spe parmi celle proposée, un nombre de filleuls compris entre 1 et 5 et un temps investi parmis ceux proposés

    if (1 <= $spe AND $spe <= 45 AND 1 <= $nbrFilleuls AND $nbrFilleuls <= 5 AND 1 <= $tempsMentorat AND $tempsMentorat <= 4) {

      // Fin de la vérification: toutes les données envoyées ont été vérifiées
      // Ajout de l'interne à la base de données

      $req = $bdd->prepare("INSERT INTO internes(nom, prenom, email, tel, numeroEtudiant, spe, nbrFilleuls, commentaire, dispoNantes, tempsMentorat, typeContactRencontre)
            VALUES(:nom, :prenom, :email, :tel, :numeroEtudiant, :spe, :nbrFilleuls, :commentaire, :dispoNantes, :tempsMentorat, :typeContactRencontre)");
      $req->execute(array(
        'nom' => $nom,
        'prenom' => $prenom,
        'email' => $email,
        'tel' => $tel,
        'numeroEtudiant' => strtoupper($numeroEtudiant),
        'spe' => $spe,
        'nbrFilleuls' => $nbrFilleuls,
        'commentaire' => $commentaire,
        'dispoNantes' => $dispoNantes,
        'tempsMentorat' => $tempsMentorat,
        'typeContactRencontre' => $typeContactRencontre
      ));
      $req->closeCursor();

      // on vérifie si il y a déjà un interne présent pour la spé choisi,

      $req = $bdd->prepare('SELECT InternesP, InternesD, spe FROM specialites WHERE id = :spe');
      $req->execute(array(
        'spe' => $spe
      ));
      $speEnTouteLettre = $req->fetch() ['spe'];
      if (!$req->fetch() ['InternesP'] || !$req->fetch() ['InternesD']) {

        // si non on change la valeur de la colonne Interne Présent (et interne dispo) dans la table Spécialité

        $updateInterneP = $bdd->prepare('UPDATE specialites SET InternesP = "1", InternesD = "1"  WHERE id = :spe');
        $updateInterneP->bindParam('spe', $spe, PDO::PARAM_INT);
        $updateInterneP->execute();
        $updateInterneP->closeCursor();
      }
      $req->closeCursor();
    }
  }
}
else {
  $message = 'Il y a eu un problème lors de votre inscription. Merci de recommencer en remplissant correctement le formulaire.';
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
    <?php if(!empty($message)){
      echo '<header class="masthead bg-danger text-white text-center"><div class="container"><h1 class="text-uppercase mb-0">' .
      $message .
      '</h1></div></header>';

    }
    else {
      echo '<header class="masthead bg-primary text-white text-center"><div class="container"><h1 class="text-uppercase mb-0">Merci pour votre inscription!</h1><hr class="star-light"></div></header>';
    } ?>


    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Et maintenant?</h2>
        <hr class="star-dark mb-5">
          <p class="lead">Une fois tous les internes volontaires inscrits, les inscriptions externes seront ouvertes. Une fois celles-ci closes, vous recevrez alors par mail la liste de vos tutorés!<br>
          Vous pouvez également consulter la liste des participants sur la 3ème catégorie dans la rubrique inscription!</p>

      </div>
    </section>

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
