function fValidationSaisie(pCodeAscii) {
  if (pCodeAscii >= 65 && pCodeAscii <= 90) { // lettre en majuscule
     return true;
  }else if (pCodeAscii >= 97 && pCodeAscii <= 122) { // lettre en minuscule
     return true;
  }else if (pCodeAscii >= 48 && pCodeAscii <= 57) { // chiffre
     return true;
  }else if (pCodeAscii == 45 || pCodeAscii == 46 || pCodeAscii == 95) { // caractère - . ou _ 
     return true;
  }else {
     window.document.getElementById("error").innerHTML="Le caractère saisi n'est pas valide";
     window.setTimeout("window.document.getElementById('error').innerHTML='';",700);
     return false;
  }
} 

function Verif(pForm) {
    if (pForm.id.value == "") {
        alert("Le nom doit être renseigné");
        pForm.id.focus();
        return false;
    }else if (pForm.id.value.length < 5) {
        alert("Le nom doit comporter au moins 5 caractères");
        pForm.id.value = "";
        pForm.id.focus();
        return false;
    }else if (isNaN(pForm.id.value) == false) {
        alert("Le nom ne doit pas être composé uniquement de chiffres");
        pForm.id.value = "";
        pForm.id.focus();
        return false;
    }else {
        for (i = 0; i < pForm.id.value.length; i++) {
            if (pForm.id.value.substr(i, 1) == "@" || pForm.Nom.value.substr(i, 1) == "&") {
                alert("Le nom ne doit pas comporter les caractères @ ou & !")
                pForm.id.value = "";
                pForm.id.focus();
                return false;
            }
        }
        return true;
    }
}

var jse = new JSEncrypt();
jse.setPublicKey("MCwwDQYJKoZIhvcNAQEBBQADGwAwGAIRANQSV0QfeHuhjPe9gPRSeE0CAwEAAQ==");
var test = jse.encrypt("voila");

jse.setPrivateKey("MGMCAQACEQDUEldEH3h7oYz3vYD0UnhNAgMBAAECECTcNzzI94kNPy18A5HMfoUCCQD3acyef1lu2wIJANtuimcI2Xn3AgkAp4Xstbk2/hcCCQDHXosfjHnUBwIIck7+Lu6dX/s=");
var test2 = jse.decrypt(test);
console.log(" ----- ");
console.log(test2);
