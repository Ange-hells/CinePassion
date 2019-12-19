<?php
/*======= C O N T R O L E U R ====================================================================================
 fichier				: ./mvc/controleur/film/accueil.inc.php
 auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
 date de création	: septembre 2019
 date de modification:
 rôle				: le contrôleur de la page d'accueil des films
 ================================================================================================================*/

/**
 /**
 * Classe relative au contrôleur de la page accueil du domaine cinepassion38
 * @author Christophe Goidin <christophe.goidin@ac-grenoble.fr>
 * @version 1.0
 * @copyright Christophe Goidin - juin 2017
 */
class controleurFilmStatistique extends controleur {
    
    private $modele;
    
    public function __construct(){
        require ("./mvc/modele/film/commun.inc.php");
        require ("./mvc/modele/film/statistique.inc.php");
        $this->modele = new modeleFilmstatistique();
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
        $this->titreHeader = "Les statistiques des films";
        $this->titreMain = "Les statistiques des films";
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
        $this->encartsDroite = "partenaires.txt";
        $this->encartsDroite = "partenaires.txt";
        $this->encartsDroite = "partenaires.txt";
        $this->encartsGauche = "partenaires.txt";
        
        // ===============================================================================================================
        // liens
        // ===============================================================================================================
        
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
        $this->nbGenre = $this->modele->getNbGenre();
        $this->nbFilmTotal = $this->modele->getTotalFilm(1980, 2019);
        $this->periode = "1980-2019";
        $this->genre = $this->modele->getGenre();
//         $this->stat = statistique::getXhtmlStatistique($this->modele->getGenre());
//         $this->filmParGenre = $this->modele->getNbFilmParGenre($i);
//         $this->filmParGenre = $this->modele->getNbFilmParGenre($unGenre);
        
      
        
      
//         $this->galerie = $this->getGalerie(configuration::get("nbImages"));
        
        parent::genererVue();
    }
    
    
    private function getGenre($i) {
        $this->modele->getGenre($i);
    }
    
    public function getNbFilmParGenre($i) {
        $this->modele->getNbFilmParGenre($i);
    }
    
    
    private function getPeriode() {
        
    }
    // 	<a href="./index.php?module=film&page=fiche&section= ".getnumfilm.">...</a>
    
} // class

?>
