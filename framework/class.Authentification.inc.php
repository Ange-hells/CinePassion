<?
class Authentification extends modele {
    /**
        * renvoie un objet anonyme comportant les informations sur l'utilisateur qui vient de s'authentifier
        * ou le booléan false si la tentative d'authentification se solde par un échec.
        * @param string $loginUser : le login de l'utilisateur
        * @param string $motDePasseUser : le mot de passe de l'utilisateur
        * @return object : un objet anonyme comportant les informations sur l'utilisateur qui vient de s'authentifier (si son login
        * et son mot de passe sont bons). Le booléen false est renvoyé si le login et/ou le mot de passe sont
        * incorrects (car la méthode fetch renvoie le booléen false lorsqu'il n'y a plus de tuples à lire)
    */
    public function __getInformationsUser($nomUtilisateur,$motDePasse){
        $sql = "SELECT prenomUser, nomUser, dateNaissanceUser, sexeUser, adresseUser, codePostalUser, villeUser, telephoneFixeUser, telephonePortableUser, mailUser, avatarUser,nbTotalConnexionUser,nbEchecConnexionUser, dateHeureCreationUser, dateHeureDerniereConnexionUser,typeUser
                FROM user WHERE loginUser='" . $nomUtilisateur . "' AND motDePasseUser=SHA2('". $motDePasse ."', 512)";
        $pdoStat = $this->executerRequete($sql);
        $info = $pdoStat->fetchObject();
            
        if (!$info){
            return false;
        }else{
            return $info;
        }
    }

    public function gestionConection (){
        $Rsa = new Crypt_RSA();
		$Rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
		$Rsa->loadKey($this->rsaPrivateKey);
		$Login = $Rsa->decrypt(base64_decode($this->requete->getParametre('username')));
		$Passwd = $Rsa->decrypt(base64_decode($this->requete->getParametre('mdp')));
        $result = $this->modele->getInformationsUser($Login,$Passwd);
    }

    /**
	    * Met à jour le nombre d'échecs de connexion
	    * @param string $loginUser : le login de l'utilisateur
	    * @param string $operation : le type d'opération à réaliser : "incrementer" ou "reinitialiser".
	    * @return null
	*/
    public function setNbEchecConnexionUser($loginUser, $operation){
		if ($operation = 'incrementer'){
			$sql = "UPDATE user SET nbEchecConnexionUser = nbEchecConnexionUser +1
 					WHERE loginUser='". $loginUser ."';";
		}else{
			$sql = "UPDATE user SET nbEchecConnexionUser = 0
 					WHERE loginUser='". $loginUser ."';";
		}
		$pdoStat = $this->executerRequete($sql);
		$nbEchecs = $pdoStat->fetchObject();
		return $nbEchecs-> nbEchecConnexionUser;
    }
    
    /**
        * Récupère la clé publique RSA
        * @param integer $num : le numéro du couple de clé RSA
        * @return string : la clé publique du couple de clés RSA dont le numéro est passé en paramètre 
    */

    public function getPublicKeyRsa($num){
        $sql = "SELECT publicKeyRsa FROM rsa WHERE numKeyRsa = " . $num;
        $pdoStat = $this->executerRequete($sql);
        $publicRSA = $pdoStat->fetchObject();
        return $publicRSA->publicKeyRsa;
    }  
        
    public function getPrivateKeyRsa($num){
        $sql = "SELECT privateKeyRsa FROM rsa WHERE numKeyRsa=" . $num;
        $pdoStat = $this->executerRequete($sql);
        $privateRSA = $pdoStat->fetchObject();
        return $privateRSA-> privateKeyRsa;
    }

    /**
	    * Récupère la durée de la connexion de l'utilisateur qui vient de se déconnecter
	    * @param string $loginUser : le login de l'utilisateur
	    * @return object : un objet anonyme composé du nombre d'heures, du nombre de minutes et du nombre de secondes de la connexion de l'utilisateur
	*/
	public function getDureeConnexion($loginUser) {
	
	}
}
