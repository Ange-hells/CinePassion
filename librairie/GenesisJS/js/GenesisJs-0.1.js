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
   }else{
      var jse = new JSEncrypt();
      jse.setPublicKey(publicKeyRsa);
      form.username.value = jse.encrypt(form.username.value);
      form.mdp.value = jse.encrypt(form.mdp.value);
      return true;
   }
}

function Deco() {
   session_unset();
   session_destroy();
   $_SESSION = Array;
   vider_cookie();
   // session_unset();
}