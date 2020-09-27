<?php
/*======= C O N T R O L E U R ====================================================================================
	fichier				: ./mvc/controleur/cinepassion38/accueil.inc.php
	auteur				: Christophe Goidin (christophe.goidin@ac-grenoble.fr)
	date de création	: juin 2017
	date de modification:
	rôle				: le contrôleur de la page d'accueil de l'association
  ================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine cinepassion38
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class controleurUserAuthentification extends controleur {
	public function __construct(){
		include_once ("./mvc/modele/user/authentification.inc.php");
		$this->modele = new modeleUtilisateurAuthentification();
	}
	/**
	 * Met à jour le tableau $donnees de la classe mère avec les informations spécifiques de la page
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.1
	 * @copyright Christophe Goidin - juin 2017
	 */
	public function setDonnees() {
		// ===============================================================================================================
		// titres de la page
		// ===============================================================================================================
		$this->titreHeader = "accueil des utilisateurs";
		$this->titreMain = "page d'accueil des utilisateurs";
				
		// ===============================================================================================================
		// encarts et texte défilant
		// ===============================================================================================================
		
		$this->encartsDroite = "meteo.txt";
		$this->encartsDroite = "partenaires.txt";
		
	
		
		
	
		// ===============================================================================================================
		// alimentation des données COMMUNES à toutes les pages
		// ===============================================================================================================
		parent::setDonnees();
	}
	
	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page 
	 * @param null
	 * @return null
	 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
	 * @version 1.0
	 * @copyright Christophe Goidin - Juin 2017
	 */
	public function defaut() {
		
		// récupération de la clé PRIVEE
		include_once("./mvc/modele/rsa.inc.php");
		//$this->rsaPrivateKey = preg_replace("/(\r\n|\n|\r)/", "",  (new modeleRSA())->getPrivateKeyRsa(configuration::get("numCoupleCleRsa")));
		$this->rsaPrivateKey = (new modeleRSA())->getPrivateKeyRsa(configuration::get("numCoupleCleRsa"));
		
		//$RsaPrivateKey = $this->modele->getPrivateKeyRsa();
		
		//=========================================================================
		// Modification du PATH et inclusion de la librairie PhpSecLib
		//=========================================================================
		
		set_include_path(get_include_path(). PATH_SEPARATOR . getcwd() . DIRECTORY_SEPARATOR . 'librairie' . DIRECTORY_SEPARATOR . "phpseclib");
		include('./librairie/Phpseclib/Crypt/RSA.php');
		//=========================================================================
		// Déchiffrement des informations du formulaire d'authentification avec la clé privée RSA
		//=========================================================================
		
		$Rsa = new Crypt_RSA();
		$Rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);
		$Rsa->loadKey($this->rsaPrivateKey);
		$Login = $Rsa->decrypt(base64_decode($this->requete->getParametre('username')));
		$Passwd = $Rsa->decrypt(base64_decode($this->requete->getParametre('mdp')));
		
		
		
			
	
		
		
		$result = $this->modele->getInformationsUser($Login,$Passwd);
		
		
		

		
		//=========================================================================
		// Le login OU le mot de passe saisis sont incorrects
		//=========================================================================
		
		if (!$result) {
			//echo "erreur de saisie<br/>";
			//include_once("./FrmAuthentification.inc.php");
			$this->AfficherContenu = false;
			

			//=========================================================================
			// Le login ET le mot de passe saisis sont corrects
			//=========================================================================
		}else{
				//variables de session
				
				
				if ($result->sexeUser == 'F'){
					$img = './image/user/femme.png';
				}elseif ($result->sexeUser == 'H'){
					$img = './image/user/homme.png';
				}
								
				if ($result->typeUser == 1){
					$typeUtilisateur = 'administrateur';
				}elseif ($result->typeUser == 2){
					$typeUtilisateur = 'membre';
				}else{
					$typeUtilisateur = 'visiteur';
				}
				
				
				$this->AfficherContenu = true;
				
				$_SESSION['Utilisateur'] = (object) array ("prenomNom" => $result->prenomUser . " " . $result->nomUser,
															"typeUser" => $typeUtilisateur,
															"image" => $img
														   );

		}
		
				
		
		//$_SESSION = (object)array('prenomUser' => $info['prenomUser'],'nomUser' => $info['nomUser'], 'dateNaissanceUser' => $info['dateNaissanceUser'], 'sexeUser' => $info['sexeUser'], 'adresseUser' => $info['adresseUser'], 'codePostalUser' => $info['codePostalUser'], 'villeUser' => $info['villeUser'],'telephoneFixeUser' => $info['telephoneFixeUser'], 'telephonePortableUser' => $info['telephonePortableUser'], 'mailUser' => $info['mailUser'], 'avatarUser' => $info['avatarUser'],'nbTotalConnexionUser'=> $info['nbTotalConnexionUser'],'nbEchecConnexionUser'=> $info['nbEchecConnexionUser'], 'dateHeureCreationUser'=> $info['dateHeureCreationUser'], 'dateHeureDerniereConnexionUser'=> $info['dateHeureDerniereConnexionUser'],'typeUser'=> $info['typeUser']);
		
		//include("./mvc/modele/user/authentification.inc.php");
		
		//$this->infoUser = $this->modele->getInformationsUser();
		//$this->nbEchecCo = $this->modele->setNbEchecConnexionUser();
		
		
		parent::genererVue();
	}

} // class

?>

