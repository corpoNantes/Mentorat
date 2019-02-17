<?php

//On récupère le nombre d'internes
$req = $bdd->query("SELECT COUNT(*) AS nbinternes FROM internes");
$nbinternes = $req->fetch()["nbinternes"];
$req->closeCursor();

//On récupère le nombre d'externes
$req = $bdd->query("SELECT COUNT(*) AS nbexternes FROM externes");
$nbexternes = $req->fetch()["nbexternes"];
$req->closeCursor();

//On récupère le nombre d'internes encore dispo
$req = $bdd->query("SELECT COUNT(*) AS nbInternesDispo FROM internes WHERE nbrFilleuls > Filleul");
$nbInternesDispo = $req->fetch()["nbInternesDispo"];
$req->closeCursor();

echo "<p>Il y a <strong>" . $nbinternes . "</strong> interne(s) d'inscrit(s) et <strong>" . $nbexternes . "</strong> externe(s) inscrit(s).<br />Il reste <strong>" . $nbInternesDispo . "</strong> interne(s) disponible(s).</p>"
?>

<h2>Internes inscrits</h2>

<div class="form-group">
  <label class="control-label" for="specialiteListe">Spécialité:</label>
  <select class="form-control" id="specialiteListe" name="specialiteListe">
    <option value="0" selected>Toutes</option>
    <?php
      $req = $bdd->query("SELECT spe, id, InternesP FROM specialites WHERE InternesP = 1");
      while($detailSpe = $req->fetch()){
        echo '<option value="' . $detailSpe['id'] . '">'. $detailSpe['spe'] . '</option>';
      }
      $req->closeCursor();
    ?>
</select>
</div>

<div class="form-group">
  <label class="control-label" for="dispo">N'afficher que les internes disponibles:</label>
  <select class="form-control" id="dispo" name="dispo">
    <option value="0" selected>non</option>
    <option value="1" >oui</option>
  </select>
</div>
<hr class="star-dark mb-5">
<div id='recap'>
  <p>Recapitulatif:<br />
    <strong><span id='total'></span></strong> internes présent dans la spécialité<br />
    <strong><span id='totalDisponible'></span></strong> disponible(s)
  </p>
</div>

<div class="table-responsive">
  <?php
  //On récupères les externes pour les afficher avec les Internes
  $req = $bdd->query("SELECT id, nom, prenom, ID_interne FROM externes");
  $donneesExternes = $req->fetchAll();
  $req->closeCursor();

  //Récupération des données des internes pour la lecture
  //On récupère aussi le nom de la spécialité stocké dans la table spécialité correspondant à l'id enregistré dans la table internes
  $req = $bdd->query("SELECT i.id AS idInterne, nom, prenom, email, tel, nbrFilleuls, commentaire, Filleul, i.spe AS idform, s.spe AS speTouteLettre
    FROM internes i, specialites s
    WHERE i.spe = s.id
    ORDER BY i.spe");
  ?>
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nom</th>
      <th scope="col">Prénom</th>
      <th scope="col">Spécialité</th>
      <th scope="col">Externes</th>
    </tr>
  </thead>
  <tbody>
    <?php
    //Affichage des données
    $i=1;
    while ($donneesInterne = $req->fetch()) {

      echo '<tr class="speI id'. $donneesInterne['idform'] . '">
        <th scope="row">' . $i . '</th>
        <td>' . htmlspecialchars($donneesInterne['nom']) . '</td>
        <td>' . htmlspecialchars(strtoupper($donneesInterne['prenom'])) . '</td>
        <td>' . $donneesInterne['speTouteLettre'] . '</td>
        <td><span class="nbrfilleul">' . $donneesInterne['Filleul'] . '</span> filleuls (maximum <span class="nbrfilleulMax">' . $donneesInterne['nbrFilleuls'] . '</span>)';

      if($donneesInterne['Filleul'] != 0){
        echo '<ul class="filleuls">';
        foreach($donneesExternes as $donneesExterne) {
          if($donneesExterne['ID_interne'] == $donneesInterne['idInterne'])
          echo '<li>' . htmlspecialchars($donneesExterne['prenom']) . ' ' . htmlspecialchars(strtoupper($donneesExterne['nom'])) . '</li>';
        }
        echo '</ul>';
      }
      echo '</td>
      </tr>';
      $i=++$i;
    }
    $req->closeCursor();
    ?>

  </tbody>
</table>
</div>
