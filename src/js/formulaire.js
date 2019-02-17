var Pun = document.getElementById("premier");
var Pdeux = document.getElementById("deuxieme");
var Ptrois = document.getElementById("troisieme");
var envoie = document.getElementById('form-work');
var envoieInterne = document.getElementById('formulaireInterne');

function verifForm(a, b) {
  if (a.value == b.value) {
     a.style.backgroundColor = 'red';
     b.style.backgroundColor = 'red';
     return true;
 }
 return false;
}

function Affichage() {
 Pun.style.backgroundColor = 'white';
 Pdeux.style.backgroundColor = 'white';
 Ptrois.style.backgroundColor = 'white';
 var deux = verifForm(Pun, Pdeux);
 var un = verifForm(Ptrois, Pdeux);
 var trois = verifForm(Pun, Ptrois);
}

Pun.onchange = function(){ Affichage(); }

Pdeux.onchange = function(){ Affichage(); }

Ptrois.onchange = function(){ Affichage(); }

var numEtudiantRegex = /^[a-zA-Z][0-9]{6}[a-zA-Z]$/;
envoie.addEventListener("submit", function(e) {
  var test = document.getElementById("numeroEtudiant");
  if(!numEtudiantRegex.test(test.value)){
    e.preventDefault();
    alert("numéro étudiant incorrect!");
    console.log("regex!");
  }
}, false);
//Regex interne num étudiant, tous les internes à nantes n'ont  pas le même format, pas utilisé
/*
var numEtudiantRegexInterne = /^[0-9]{2}[a-zA-Z][0-9]{3}[a-zA-Z]$/;
envoieInterne.addEventListener("submit", function(e) {
  var test = document.getElementById("numeroEtudiant1");
  if(!numEtudiantRegexInterne.test(test.value)){
    e.preventDefault();
    alert("numéro étudiant incorrect!");
    console.log("regex!");
  }
}, false);
*/



envoie.addEventListener("submit", function(e) {
  Pun.style.backgroundColor = "white";
  Pdeux.style.backgroundColor = "white";
  Ptrois.style.backgroundColor = "white";

  if (verifForm(Pun, Pdeux) || verifForm(Pun, Ptrois) || verifForm(Pdeux, Ptrois)) {
      e.preventDefault();
      document.getElementById("avertissement").innerHTML = "Vous avez mis 2 fois le même critère!";
  }
}, false);

var nbrFilleul = document.getElementById("nbrFilleulsRange");
var affichageNbrFilleul = document.getElementById("nbrF");
affichageNbrFilleul.innerHTML = nbrFilleul.value;

nbrFilleul.addEventListener("input", function(e) {
    affichageNbrFilleul.innerHTML = e.target.value;
}, false);
