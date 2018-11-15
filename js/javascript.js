var i = 30000;
var s = i /1000;

var compteur = document.getElementById("compteur");

Fcompteur(compteur, s);

function Fcompteur(compteur, s) {
      
    setTimeout(function() {
        Fcompteur(compteur, s - 1);
    }, 1000);
	if (s > 1) {
        compteur.textContent = "updated : " + s + " secondes";
    }
	else {
		compteur.textContent = "updated : " + s + " seconde";
	}
}

window.setTimeout("window.location.reload();",i);