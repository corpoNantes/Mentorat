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
        <a class="navbar-brand js-scroll-trigger" href="#page-top"><img src = "img/CNEM.png" alt=""/> Mentorat</a>
        <button class="navbar-toggler navbar-toggler-right text-uppercase bg-primary text-white rounded" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          Menu
          <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#portfolio">Inscription</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#about">Quésaco?</a>
            </li>
            <li class="nav-item mx-0 mx-lg-1">
              <a class="nav-link py-3 px-0 px-lg-3 rounded js-scroll-trigger" href="#contact">Contact</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Header -->
    <header class="masthead bg-primary text-white text-center">
      <div class="container">
        <img class="img-fluid mb-5 d-block mx-auto" src="img/diplome.png" alt="">
        <h1 class="text-uppercase mb-0">Mentorat</h1>
        <hr class="star-light">
        <h2 class="font-weight-light mb-0">Pour les étudiants - Par les étudiants</h2>
      </div>
    </header>

    <!-- Portfolio Grid Section -->
    <section class="portfolio" id="portfolio">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Inscription</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-1">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/cabin.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-2">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/cake.png" alt="">
            </a>
          </div>
          <div class="col-md-6 col-lg-4">
            <a class="portfolio-item d-block mx-auto" href="#portfolio-modal-3">
              <div class="portfolio-item-caption d-flex position-absolute h-100 w-100">
                <div class="portfolio-item-caption-content my-auto w-100 text-center text-white">
                  <i class="fas fa-search-plus fa-3x"></i>
                </div>
              </div>
              <img class="img-fluid" src="img/portfolio/circus.png" alt="">
            </a>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section class="bg-primary text-white mb-0" id="about">
      <div class="container">
        <h2 class="text-center text-uppercase text-white">Quesaco?</h2>
        <hr class="star-light mb-5">
        <div class="row">
          <div class="col-lg-4 ml-auto">
            <p class="lead">Le Mentorat est une structure d'aide a destination des externes mis en place par la CNEM. Il consiste a mettre en relation des internes et des externes ayant les mêmes critères, suivant la spécialité, le type de contact recherché, la localisation et le nombre d'heures consacrées.</p>
          </div>
          <div class="col-lg-4 mr-auto">
            <p class="lead">Comment ça marche?</p>
            <ul>
              <li>Les internes s'inscrivent d'abord,</li>
              <li>puis c'est le tour des externes!</li>
            </ul>
            <p class="lead">Les externes se voient automatiquement attribués un interne en fonction des critères qu'ils ont remplis lors de leur inscription.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
      <div class="container">
        <h2 class="text-center text-uppercase text-secondary mb-0">Nous contacter</h2>
        <hr class="star-dark mb-5">
        <div class="row">
          <div class="col-lg-8 mx-auto">
            <!-- To configure the contact form email address, go to mail/contact_me.php and update the email address in the PHP file on line 19. -->
            <!-- The form should work on most web servers, but if the form is not working you may need to configure your web server differently. -->
            <form name="sentMessage" id="contactForm" novalidate="novalidate">
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Nom</label>
                  <input class="form-control" id="name" type="text" placeholder="Nom" required="required" data-validation-required-message="Entrer votre nom svp.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Adresse email</label>
                  <input class="form-control" id="email" type="email" placeholder="Adresse email" required="required" data-validation-required-message="Entrer votre adresse email svp.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Numéro de téléphone</label>
                  <input class="form-control" id="phone" type="tel" placeholder="Numéro de téléphone" required="required" data-validation-required-message="Entrer votre numéro de téléphone.">
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <div class="control-group">
                <div class="form-group floating-label-form-group controls mb-0 pb-2">
                  <label>Message</label>
                  <textarea class="form-control" id="message" rows="5" placeholder="Message" required="required" data-validation-required-message="Entrer un message."></textarea>
                  <p class="help-block text-danger"></p>
                </div>
              </div>
              <br>
              <div id="success"></div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary btn-xl" id="sendMessageButton">Envoyer</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
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

    <!-- Portfolio Modals -->

    <!-- Portfolio Modal 1 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-1">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Externes</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/cabin.png" alt="">
              <p class="mb-5">Inscrit toi pour participer au Mentorat!</p>
              <form action="externes.php" id="form-work" method="post">
               <div class="form-group">
                 <label class="control-label" for="name">Nom</label>
                 <input class="form-control" id="name" name="name" placeholder="Nom" type="text" required>
               </div>
               <div class="form-group">
                 <label class="control-label" for="prenom">Prénom</label>
                 <input class="form-control" id="prenom" name="prenom" placeholder="Prénom" type="text" required>
               </div>

               <div class="form-group">
                 <label class="control-label" for="contact">Teléphone</label>
                 <input class="form-control" id="contact" name="contact" placeholder="06********" type="tel" required>
               </div>

               <div class="form-group">
                 <label class="control-label" for="numeroEtudiant">Numéro Etudiant</label>
                 <input class="form-control" id="numeroEtudiant" name="numeroEtudiant" placeholder="E147864A" type="text" required>
               </div>

               <div class="form-group">
                 <label class="control-label" for="email">Email</label>
                 <input class="form-control" id="email" name="email" placeholder="monadresse@mondomaine.com" type="email" required>
               </div>
               <br>
               <h2>Mes critères</h2>
               <div class="form-group">
                 <label class="control-label" for="specialite">Spécialité:</label>
                 <select class="form-control" id="specialite" name="specialite" required>
                   <option hidden disabled selected value="">Spécialité</option>
                   <?php
                   $req = $bdd->query("SELECT s.spe, s.id FROM specialites s WHERE
	                         (SELECT SUM(nbrFilleuls - Filleul) FROM internes i WHERE spe=s.id)
	                         -
	                         (SELECT COUNT(*) FROM externes WHERE ID_interne = -1) != 0;
                          ") ;

                     while($detailSpe = $req->fetch()){
                       echo '<option value="' . $detailSpe['id'] . '">' . $detailSpe['spe'] . '</option>';
                     }
                     $req->closeCursor();
                     ?>
                   </select>
               </div>

               <div class="form-group">
                 <label class="control-label" for="dispoNantes">Disponible sur Nantes (au moins partiellement en fonction des semestres):</label>
                 <select class="form-control" id="dispoNantes" name="dispoNantes" required>
                   <option value="" hidden selected disabled>Choisir oui ou non</option>
                   <option value="1">Oui</option>
                   <option value="0">Non</option>
                 </select>
               </div>

               <div class="form-group">
                 <label class="control-label" for="typeContact">Type de contact souhaité:</label>
                 <select class="form-control" id="typeContact" name="typeContact" required>
                   <option value="" hidden selected disabled>Type de contact</option>
                   <option value="1">Rencontres</option>
                   <option value="0">sms, mails, appels...</option>
                 </select>
               </div>

               <div class="form-group">
                 <label class="control-label" for="tempsMentorat">Fréquence des contacts:</label>
                 <select class="form-control" id="tempsMentorat" name="tempsMentorat" required>
                   <option value="" hidden selected disabled>Fréquence</option>
                   <option value="1">hebdomaire</option>
                   <option value="2">bi-mensuel</option>
                   <option value="3">mensuel</option>
                   <option value="4">bi-semestriel</option>
                 </select>
               </div>
               <br>
               <div class="form-group">
                 <h2>Priorité des critères:</h2>
                 <p id="avertissement" style="font-style:italic; color: red;"></p>
               </div>

               <div class="form-group">
                 <label class="control-label" for="premier">Priorité 1</label>
                 <select class="form-control" id="premier" name="premier">
                   <option value="1" selected>Type de contact</option>
                   <option value="2">Fréquence des contacts</option>
                   <option value="3">Disponible sur Nantes</option>
                 </select>
               </div>

               <div class="form-group">
                 <label class="control-label" for="deuxieme">Priorité 2</label>
                <select class="form-control" id="deuxieme" name="deuxieme">
                  <option value="1" >Type de contact</option>
                  <option value="2" selected>Fréquence des contacts</option>
                  <option value="3">Disponible sur Nantes</option>
                </select>
               </div>

               <div class="form-group">
                 <label class="control-label" for="troisieme">Priorité 3</label>
                <select class="form-control" id="troisieme" name="troisieme">
                  <option value="1">Type de contact</option>
                  <option value="2">Fréquence des contacts</option>
                  <option value="3" selected>Disponible sur Nantes</option>
                </select>
               </div>

              <button class="btn btn-primary btn-lg btn-block info" type="submit">Envoyer</button>
              </form>
              <br>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 2 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-2">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Internes</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/cake.png" alt="">
              <p class="mb-5">Merci à toi de participer au Mentorat! Rempli le formulaire ci-dessous afin qu'on puisse t'attribuer des externes te correspondant au mieux!</p>
              <form id="formulaireInterne" action="internes.php" method="post">
              <div class="form-group">
                <label class="control-label" for="name1">Nom</label>
                <input class="form-control" id="name1" name="name1" placeholder="Nom" type="text" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="prenom1">Prénom</label>
                <input class="form-control" id="prenom1" name="prenom1" placeholder="Prénom" type="text" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="contact1">Teléphone</label>
                <input class="form-control" id="contact1" name="contact1" placeholder="06********" type="text" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="numeroEtudiant1">Numéro Etudiant</label>
                <input class="form-control" id="numeroEtudiant1" name="numeroEtudiant1" placeholder="17D344E" type="text" required>
              </div>

              <div class="form-group">
                <label class="control-label" for="email1">Email</label>
                <input class="form-control" id="email1" name="email1" placeholder="monadresse@mondomaine.com" type="email" required>
              </div>
              <br>
              <h2>Mes études</h2>
              <div class="form-group">
                <label class="control-label" for="specialite1">Spécialité:</label>
                <select class="form-control" id="specialite1" name="specialite1" required>
                      <option hidden disabled selected value="">Spécialité</option>
                      <option value="1">Allergologie</option>
                      <option value="2">Anesthésie-Réanimation</option>
                      <option value="3">Anatomie et Cytologie pathologiques</option>
                      <option value="4">Biologie médicale</option>
                      <option value="5">Chirurgie Maxillo-Faciale</option>
                      <option value="6">Chirurgie Orale </option>
                      <option value="7">Chirurgie Orthopédique et traumatologique</option>
                      <option value="8">Chirurgie Pédiatrique</option>
                      <option value="9">Chirurgie plastique, reconstructrice et esthétique </option>
                      <option value="10">Chirurgie Thoracique et Cardio-Vasculaire</option>
                      <option value="11">Chirurgie Vasculaire</option>
                      <option value="12">Chirurgie Viscérale et Digestive</option>
                      <option value="13">Dermatologie – Vénérologie</option>
                      <option value="14">Endocrinologie, diabétologie et nutrition</option>
                      <option value="15">Génétique médicale</option>
                      <option value="16">Gériatrie</option>
                      <option value="17">Gynécologie médicale</option>
                      <option value="18">Gynécologie – Obstétrique</option>
                      <option value="19">Hématologie</option>
                      <option value="20">Hépato-gastro-entérologie</option>
                      <option value="21">Maladies Infectieuses et Tropicales</option>
                      <option value="22">Médecine Cardiovasculaire</option>
                      <option value="23">Médecine Générale</option>
                      <option value="24">Médecine Intensive-Réanimation</option>
                      <option value="25">Médecine Interne et Immunologie clinique</option>
                      <option value="26">Médecine Légale et expertise médicale</option>
                      <option value="27">Médecine Nucléaire</option>
                      <option value="28">Médecine Physique et Réadaptation</option>
                      <option value="29">Médecine et Santé au Travail</option>
                      <option value="30">Médecine Vasculaire</option>
                      <option value="31">Médecine d’Urgence</option>
                      <option value="32">Néphrologie</option>
                      <option value="33">Neurochirurgie</option>
                      <option value="34">Neurologie</option>
                      <option value="35">Oncologie : Option précoce – Oncologie Médicale</option>
                      <option value="36">Oncologie : Option précoce – Radiothérapie</option>
                      <option value="37">Ophtalmologie</option>
                      <option value="38">Oto-rhino-laryngologie et chirurgie cervico-faciale</option>
                      <option value="39">Pédiatrie</option>
                      <option value="40">Pneumologie</option>
                      <option value="41">Psychiatrie</option>
                      <option value="42">Radiologie et Imagerie Médicale</option>
                      <option value="43">Rhumatologie </option>
                      <option value="44">Santé publique</option>
                      <option value="45">Urologie</option>
                  </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="nbrFilleulsRange">Nombre de filleul(s) max : <span id="nbrF"></span></label>
                <input class="form-control" type="range" id="nbrFilleulsRange" name="nbrFilleulsRange"  min="1" max="5" value="3">
              </div>

              <div class="form-group">
                <label class="control-label" for="dispoNantes1">Disponible sur Nantes (au moins partiellement en fonction des semestres):</label>
                <select class="form-control" id="dispoNantes1" name="dispoNantes1" required>
                  <option value="" hidden selected disabled>Choisir oui ou non</option>
                  <option value="1">Oui</option>
                  <option value="0">Non</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="typeContact1">Type de contact souhaité:</label>
                <select class="form-control" id="typeContact1" name="typeContact1" required>
                  <option value="" hidden selected disabled>Type de contact</option>
                  <option value="1">Rencontres</option>
                  <option value="0">sms, mails, appels...</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="tempsMentorat1">Fréquence des contacts:</label>
                <select class="form-control" id="tempsMentorat1" name="tempsMentorat1" required>
                  <option value="" hidden selected disabled>Fréquence</option>
                  <option value="1">hebdomaire</option>
                  <option value="2">bi-mensuel</option>
                  <option value="3">mensuel</option>
                  <option value="4">bi-semestriel</option>
                </select>
              </div>

              <div class="form-group">
                <label class="control-label" for="commentaire1">Description (facultative) : </label>
                <textarea class="form-control" id="commentaire1" name="commentaire1" cols="15" placeholder="Message" rows="10"></textarea>
              </div>

              <div class="form-group">
                <button class="btn btn-primary btn-lg btn-block info" type="submit">Envoyer</button>
              </div>
            </form>

              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer</a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Portfolio Modal 3 -->
    <div class="portfolio-modal mfp-hide" id="portfolio-modal-3">
      <div class="portfolio-modal-dialog bg-white">
        <a class="close-button d-none d-md-block portfolio-modal-dismiss" href="#">
          <i class="fa fa-3x fa-times"></i>
        </a>
        <div class="container text-center">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <h2 class="text-secondary text-uppercase mb-0">Liste des inscrits</h2>
              <hr class="star-dark mb-5">
              <img class="img-fluid mb-5" src="img/portfolio/circus.png" alt="">
              <?php include 'lectureInscrit.php';?>
              <a class="btn btn-primary btn-lg rounded-pill portfolio-modal-dismiss" href="#">
                <i class="fa fa-close"></i>
                Fermer</a>
            </div>
          </div>
        </div>
      </div>
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
    <script src="js/formulaire.js"></script>
    <script src="js/InternesListe.js"></script>


  </body>

</html>
