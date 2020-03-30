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
     window.setTimeout("window.document.getElementById('error').innerHTML='';",1000);
     return false;
  }
} 

function Verif(pForm) {
    if (pForm.id.value == "") {
        window.document.getElementById("error").innerHTML="Le nom doit être renseigné";
        window.setTimeout("window.document.getElementById('error').innerHTML='';",1000)
        pForm.id.focus();
        return false;
    }else if (pForm.id.value.length < 5) {
        window.document.getElementById("error").innerHTML="Le nom doit comporter au moins 5 caractères";
        window.setTimeout("window.document.getElementById('error').innerHTML='';",1000)
        pForm.id.value = "";
        pForm.id.focus();
        return false;
    }else if (isNaN(pForm.id.value) == false) {
        window.document.getElementById("error").innerHTML="Le nom ne doit pas être composé uniquement de chiffres";
        window.setTimeout("window.document.getElementById('error').innerHTML='';",1000)
        pForm.id.value = "";
        pForm.id.focus();
        return false;
    }
    var jse = new JSEncrypt();
    jse.setPublicKey("MCwwDQYJKoZIhvcNAQEBBQADGwAwGAIRANQSV0QfeHuhjPe9gPRSeE0CAwEAAQ==");
    var test = jse.encrypt(window.document.getElementByName("passe"));
    
    
}