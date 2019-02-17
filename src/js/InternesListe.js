//formulaire
var spe = document.getElementById("specialiteListe");
var dispoForm = document.getElementById("dispo");

//par default -> 0 = tout
var spePrecedente = 0;

//tous les tr (ligne tableau)
var allInternes = document.querySelectorAll('.speI');
//tous les nombres de filleuls par interne (même index que allInternes)
var nbrFilleul = document.querySelectorAll('.nbrfilleul');
//tous les nombres de filleuls max par interne (même index que allInternes)
var nbrFilleulMax = document.querySelectorAll(".nbrfilleulMax");

var internesSelected = new Array();

var libelleRecap = document.getElementById("recap");
var recapNode;
var tableau = document.querySelector('.table-responsive');
var total = document.getElementById("total");
var totalDisponible = document.getElementById("totalDisponible");
recapNode = libelleRecap.parentNode.removeChild(libelleRecap);


function affichageInternesParSpe() {
  //On efface tous les internes
		for (var i = 0; i < allInternes.length; i++) {
			allInternes[i].setAttribute("hidden", "");
		}

    //on affiche maintenant les nouveaux

  if(spe.value == 0){
    if(libelleRecap.parentNode)
      recapNode = libelleRecap.parentNode.removeChild(libelleRecap);

    for (var i = 0; i < allInternes.length; i++) {

      if(dispoOnly) {

        if (nbrFilleul[i].innerHTML == nbrFilleulMax[i].innerHTML)
          allInternes[i].setAttribute("hidden", "");
        else
          allInternes[i].removeAttribute("hidden");

      }
      else
			   allInternes[i].removeAttribute("hidden");

	  }

  }

  else {

    tableau.parentNode.insertBefore(recapNode, tableau);

	  //On affiche les nouveaux
	  internesSelected = document.querySelectorAll('.id' + spe.value);
    var compteur = 0;

	    for (var i = 0; i < internesSelected.length; i++) {

        var nbrFilleulSelected = internesSelected[i].querySelector('.nbrfilleul');
        var nbrFilleulMaxSelected = internesSelected[i].querySelector(".nbrfilleulMax");

        if(nbrFilleulMaxSelected.innerHTML != nbrFilleulSelected.innerHTML){
          compteur= ++compteur;
        }

        if(dispoOnly){
          if(nbrFilleulMaxSelected.innerHTML != nbrFilleulSelected.innerHTML)
            internesSelected[i].removeAttribute('hidden');
        }
        else {
          internesSelected[i].removeAttribute('hidden');
        }
      }

      totalDisponible.innerHTML = compteur;
      total.innerHTML = internesSelected.length;

	 }
}


spe.onchange = function() {
  dispoOnly = dispoForm.value == 1 ? true : false;
  affichageInternesParSpe();
  spePrecedente = spe.value;
}

dispoForm.onchange = function() {
  dispoOnly = dispoForm.value == 1 ? true : false;
  affichageInternesParSpe();
}
