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
class controleurFilmFiche extends controleur {
    
    private $modele;
    
    public function __construct(){
        require ("./mvc/modele/film/commun.inc.php");
        require ("./mvc/modele/film/fiche.inc.php");
        $this->modele = new modeleFilmFiche();
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
        $this->titreHeader = "Fiche descriptive";
        $this->titreMain = "Description du film n°$this->section :"; //$this->TitreFilm";
        
        // ===============================================================================================================
        // encarts
        // ===============================================================================================================
        $this->encartsDroite = "partenaires.txt";
        $this->encartsDroite = "partenaires.txt";
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
        $this->numFilm = $this->section;
        $this->listeActeur = $this->modele->getListeActeur($this->numFilm);
        $this->nav = new navigation($this->module, $this->page, $this->action, $this->section,  $this->nbFilms);
//         $this->listeNote = $this->modele->getNote($this->numFilm);
        
        $this->TitreFilm = $this->modele->getTitreFilm($this->numFilm);
        $this->PaysFilm = $this->modele->getPays($this->numFilm);
        $this->GenreFilm = $this->modele->getGenre($this->numFilm);
        $this->PositionFilm = $this->modele->getPosition($this->numFilm);
        $this->PaysReal = $this->modele->getPaysReal($this->numFilm);
        $this->PrenomReal = $this->modele->getPrenomReal($this->numFilm);
        $this->NomReal = $this->modele->getNomReal($this->numFilm);
        $this->DureeFilm = $this->modele->getDureeFilm($this->numFilm);
        $this->DateSortie = $this->modele->getDateSortie($this->numFilm);
        
        $this->Synopsis = $this->modele->getSynopsis($this->numFilm);
        
        $this->nbActeur = $this->modele->getNbActeur($this->numFilm);

        $this->note = $this->modele->getNote($this->numFilm);
        $this->Etoile = $this->getEtoile($this->note);
        
        $this->affiche = $this->getAffiche($this->TitreFilm);
        $this->photo = $this->getPhotos($this->numFilm);
        // 	    $this->galerie = $this->getGalerie(configuration::get("nbImages"));
        
        parent::genererVue();
    }
    
    private function getAffiche($TitreFilm) {
        $affiche = "./././image/film/affiche/$TitreFilm.jpg"; // declare le chemin du dossier
        if (!file_exists($affiche)){
           return $affiche = "<img src= './././image/film/affiche/Aucune affiche.jpg'>";
        }else{
           return $affiche = "<img src='./././image/film/affiche/$TitreFilm'.jpg>";
        }
    }
        
    private function getPhotos($TitreFilm) {
        $dossier = "./image/film/photo/$TitreFilm/"; // declare le chemin du dossier
        if (!file_exists($dossier)){
            return $Photos = "";
        }else{
            return $Photos = [glob($dossier.'*.jpg')];
        }
        
    }

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
    
    private function getEtoile($uneNote){
        switch ($uneNote) {
            case 20 or 19:
                echo "<img src'./././image/divers/etoiles/50.png'>";
                break;
            case 18 or 17:
                echo "<img src'./././image/divers/etoiles/45.png'>";
                break;
            case 16 or 15:
                echo "<img src'./././image/divers/etoiles/40.png'>";
                break;
            case 14 or 13:
                echo "<img src'./././image/divers/etoiles/35.png'>";
                break;
            case 12 or 11:
                echo "<img src'./././image/divers/etoiles/30.png'>";
                break;
            case 10:
                echo "<img src'./././image/divers/etoiles/25.png'>";
                break;
            case 9 or 8:
                echo "<img src'./././image/divers/etoiles/20.png'>";
                break;
            case 7 or 6:
                echo "<img src'./././image/divers/etoiles/15.png'>";
                break;
            case 5 or 4:
                echo "<img src'./././image/divers/etoiles/10.png'>";
                break;
            case 3 or 2:
                echo "<img src'./././image/divers/etoiles/05.png'>";
                break;
            case 0 or 1 :
                echo "<img src'./././image/divers/etoiles/0.png'>";
                break;
        }
    }
    
    // 	<a href="./index.php?module=film&page=fiche&section= ".getnumfilm.">...</a>
    
} // class
