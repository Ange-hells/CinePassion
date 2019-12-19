<?php
/*======= C O N T R O L E U R ====================================================================================
 fichier				: ./mvc/controleur/film/liste.inc.php
 auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
 date de création	: octobre 2019
 date de modification:
 rôle				: le contrôleur de la page d'accueil des films
 ================================================================================================================*/
class controleurFilmListe extends controleur{
    
    private $modele;
    
    public function __construct(){
        require ("./mvc/modele/film/commun.inc.php");
        require ("./mvc/modele/film/liste.inc.php");
        require ("./framework/class.navigation.inc.php");
        $this->modele = new modeleListeFilm();
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
        $this->titreHeader = "Liste des films";
        $this->titreMain = "liste des films";
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
        $this->encartsGauche = "partenaires.txt";
        
        // ===============================================================================================================
        // liens
        // ===============================================================================================================
        
        
        //===============================================================================================================
        // navigation
        //===============================================================================================================
        $this->nbFilms = $this->modele->getNbrFilm(); 
        $this->nbFilmsParSection = configuration::get("nbFilmsParSection");
        $this->nbSections = round(($this->nbFilms/$this->nbFilmsParSection),  0, PHP_ROUND_HALF_UP); //Donne le nombre de section arrondi au superieur
       // $this->sectionCourante =$this->modele->getSectionCourante(/*$this->section, $this->nbSections*/); //Determine la section Courante
        
        //$this->dernierFilm = ($this->section) * ($this->nbFilmsParSection);
        $this->numPremierFilm = ($this->section - 1) * ($this->nbFilmsParSection) + 1; //Donne le numero du premier film de la section
        $this->numDernierFilm = ($this->section == $this->nbSections ? $this->nbFilms : $this->section * $this->nbFilmsParSection); //Donne le numero du dernier film de la section
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
        $this->listeFilm = $this->modele->getListeFilms(($this->numPremierFilm-1), $this->nbFilmsParSection);
        $this->nbAffiches = configuration::get("nbAffiches");
//         $this->nbFilmsParSection = configuration::get("nbFilmsParSection");
//         $this->nbSections = round(($this->nbFilms/$this->nbFilmsParSection),  0, PHP_ROUND_HALF_UP); //Donne le nombre de section arrondi au superieur
//         $this->sectionCourante =$this->modele->getSectionCourante($this->section, $this->nbSections); //Determine la section Courante
//         $this->dernierFilm = ($this->sectionCourante) * ($this->nbFilmsParSection);
//         $this->numPremierFilm = ($this->sectionCourante - 1) * ($this->nbFilmsParSection) + 1; //Donne le numero du premier film de la section
//         $this->numDernierFilm = ($this->dernierFilm > $this->nbFilms)? $this->nbFilms : $this->dernierFilm; //Donne le numero du dernier film de la section
        
        $this->nav = new navigation($this->module, $this->page, $this->action, $this->section,  $this->nbSections);    
        //$this->numeros = $this->nav->getNumeros(configuration::get("nbAffiches"));
        
        parent::genererVue();
    }
    
} // class

?>