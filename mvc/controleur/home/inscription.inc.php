<?php
/*======= C O N T R O L E U R ====================================================================================
 fichier			: ./mvc/controleur/home/inscription.inc.php
 auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
 date de création	: novenbre 2019
 date de modification:
 rôle				: le contrôleur de la page d'accueil des films
 ================================================================================================================*/
class controleurHomeInscription extends controleur{
    
    private $modele;
    
    public function __construct(){
        require ("./mvc/modele/film/commun.inc.php");
        require ("./mvc/modele/home/Inscription.inc.php");
        $this->modele = new modeleHomeInscription();
                
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
        $this->titreHeader = "Inscription";
        $this->titreMain = "formulaire d'inscription";
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
//         $this->encartsGauche = "partenaires.txt";
        
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
        $this->img = 24;
        $this->Profil_Name = 03;
        $this->Profil_Type = 52;

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
//         $this->nbFilms = $this->modele->getNbrFilm(); //Donne le nombre de films
//         $this->listeFilm = $this->modele->getListeFilms(); //Recupere la liste des films
//         $this->nbFilmsParSection = configuration::get("nbFilmsParSection"); //Donne le nombre de film afficher par section
//         $this->nbSections = round(($this->nbFilms/$this->nbFilmsParSection),  0, PHP_ROUND_HALF_UP); //Donne le nombre de section arrondi au superieur
//         $this->nav = new navigation($this->module, $this->page, $this->action, $this->section, $this->nbSections); //Instencie la class navigation
//         $this->sectionCourante = ($this->section < $this->nbSections) ? ($this->section < 1) ? $this->section = 1 : $this->section : $this->section = $this->nbSections; //Determine la section Courante
//         $this->dernierFilm = ($this->sectionCourante) * ($this->nbFilmsParSection);
//         //         nbfilms+ (nbfilmsection*(section)-1))
//         $this->numPremierFilm = ($this->sectionCourante - 1) * ($this->nbFilmsParSection) + 1; //Donne le numero du premier film de la section
//         $this->numDernierFilm = ($this->dernierFilm > $this->nbFilms)? $this->nbFilms : $this->dernierFilm; //Donne le numero du dernier film de la section
//         $this->numeros = $this->nav->getNumeros(configuration::get("nbAffiches"));
        parent::genererVue();
    }
    
} // class

?>