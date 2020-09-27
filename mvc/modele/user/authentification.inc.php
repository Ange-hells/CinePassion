<?php

class modeleUtilisateurAuthentification extends modele{
	/**
		* renvoie un objet anonyme comportant les informations sur l'utilisateur qui vient de s'authentifier
		* ou le booléan false si la tentative d'authentification se solde par un échec.
		* @param string $loginUser : le login de l'utilisateur
		* @param string $motDePasseUser : le mot de passe de l'utilisateur
		* @return object : un objet anonyme comportant les informations sur l'utilisateur qui vient de s'authentifier (si son login
		* et son mot de passe sont bons). Le booléen false est renvoyé si le login et/ou le mot de passe sont
		* incorrects (car la méthode fetch renvoie le booléen false lorsqu'il n'y a plus de tuples à lire)
	*/
	


	public function getInformationsUser($nomUtilisateur,$motDePasse){
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
	 * Met à jour la date et l'heure de dernière connexion de l'utilisateur
	 * @param string $loginUser : le login de l'utilisateur
	 * @return null
	 */
	
	/*public function setdateHeureDerniereConnexionUser($loginUser){
	
			$sql = "select DATE_FORMAT(dateHeureCreationUser, '%k')as Heures ,DATE_FORMAT(dateHeureCreationUser, '%i') as Minutes
					from user 
					WHERE loginUser='". $loginUser ."';";
			
			
			

		$pdoStat = $this->executerRequete($sql);
		$derniereConnexion = $pdoStat->fetchObject();
		return $derniereConnexion->dateHeureDerniereConnexionUser ;
	}
	
	public function setdateHeureDerniereConnexionUser($loginUser){
	
		$sql = "select DATE_FORMAT(dateHeureCreationUser, '%k')as Heures
				from user
				WHERE loginUser='". $loginUser ."';";
			
			
			
	
		$pdoStat = $this->executerRequete($sql);
		$heureDerniereCo = $pdoStat->fetchObject();
		
		return $heureDerniereCo ;
	}*/
	

}

?>