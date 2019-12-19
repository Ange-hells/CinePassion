<?php
/*======= C O N T R O L E U R ====================================================================================
fichier				: ./mvc/controleur/film/accueil.inc.php
auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
date de création	: septembre 2019
date de modification:
rôle				: le contrôleur de la page d'accueil des films
================================================================================================================*/

/**
 * Classe relative au contrôleur de la page accueil du domaine cinepassion38
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class controleurFilmAccueil extends controleur {    
    
    private $modele;
    
    public function __construct(){
        require ("./mvc/modele/film/commun.inc.php");
        require ("./mvc/modele/film/accueil.inc.php");
        $this->modele = new modeleFilmAccueil();
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
		$this->titreHeader = "Accueil";
		$this->titreMain = "page d'accueil des films";
	
		// ===============================================================================================================
		// encarts
		// ===============================================================================================================
    	$this->encartsDroite = "partenaires.txt";
				
    	// ===============================================================================================================
    	// liens 
    	// ===============================================================================================================
    	$this->enteteLien = "<script type='text/javascript' src='./librairie/slidesjs/js/slides.min.jquery.js'></script>\n";

		// ===============================================================================================================
		// texte défilant
		// ===============================================================================================================
		// rien
		
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
	    $this->nbFilms = $this->modele->getNbrFilm();
 	    $this->galerie = $this->getGalerie(configuration::get("nbImages"));
	    
		parent::genererVue();
	}

	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page
	 * @param nbImages
	 * @return $result
	 * @author Thomasset Nathan <nathan.thomasset2@gmail.com>
	 * @version 1.0
	 * @copyright Thomasset nathan - Octobre 2019
	 */
	private function getGalerie($nbImages) {
	    $dossier = "./image/film/affiche/"; // le chemin du dossier
	    $lesAffiches = glob($dossier.'*.jpg'); // fonction glob pour chercher tous les chemins qui vérifient ($dossier, '*.jpg')
	    for ($i = 0; $i < count($lesAffiches); $i++) { // donne le nb d'affiche
	        $lesAffiches[$i] = ($lesAffiches[$i]);
	    }
	    unset($lesAffiches[array_search($dossier . "Aucune affiche.jpg", $lesAffiches)]);
	    $result = array();
	    for ($i = 1;  $i <= $nbImages; $i++) {
	        do {
	            $nbAlea = mt_rand(0, count($lesAffiches) - 1);
	        }while ($this->estPresent($lesAffiches[$nbAlea], $result, array($dossier . "Aucune affiche.jpg")));
	        $result['affiche'] = $lesAffiches[$nbAlea];
	        
	    }
	    return $result;
	}	
	
	/**
	 * Génère l'affichage de la vue pour l'action par défaut de la page
	 * @param valeurChercher, tab, exclusion
	 * @return bool (true or fals)
	 * @author Thomasset Nathan <nathan.thomasset2@gmail.com>
	 * @version 1.0
	 * @copyright Thomasset nathan - Octobre 2019
	 */
	private function estPresent($valeurChercher, $tab, $exclusion) {
	    if (in_array($valeurChercher, $exclusion)) {
	        return true;
	    }else {
	        foreach ($tab as $unElement) {
	            if ($valeurChercher == $unElement['affiche']) {
	                return true;
	            }
	        }
	        return false;
	    }
	}
	
// 	<a href="./index.php?module=film&page=fiche&section= ".getnumfilm.">...</a>

} // class

?>
