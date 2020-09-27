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
class controleurUserAccueil extends controleur {
	public function __construct(){
		include ("./mvc/modele/rsa.inc.php");
		$this->modele = new modeleRSA();
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
		$this->encartsGauche = "partenaires.txt";
		$this->encartsGauche = "dernieresActualites.txt";
		$this->encartsDroite = "meteo.txt";
		$this->encartsDroite = "partenaires.txt";
		
		// ===============================================================================================================
		// authentification
		// ===============================================================================================================
		//$this->authentification = getContenuFichier('./formulaire/form.authentificationUser.inc.php');
		
		//$this->enteteLien = "<link rel='stylesheet' type='text/css' href='./css/formulaire.css' />\n";
							
		
		$this->clePublic = $this->modele->getPublicKeyRsa(1);
		
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
		parent::genererVue();
	}

} // class

?>

