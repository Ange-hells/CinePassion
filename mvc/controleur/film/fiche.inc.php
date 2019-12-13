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
        $this->encartsGauche = "partenaires.txt";
      
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
        
        $this->TitreFilm = $this->modele->getTitreFilm($this->numFilm);
        $this->PaysFilm = $this->modele->getPays($this->numFilm);
        $this->GenreFilm = $this->modele->getGenre($this->numFilm);
//         $this->PositionFilm = $this->modele->getPosition($this->numFilm);
        $this->PaysReal = $this->modele->getPaysReal($this->numFilm);
        $this->PrenomReal = $this->modele->getPrenomReal($this->numFilm);
        $this->NomReal = $this->modele->getNomReal($this->numFilm);
        $this->DureeFilm = $this->modele->getDureeFilm($this->numFilm);
        $this->DateSortie = $this->modele->getDateSortie($this->numFilm);
        
        $this->Synopsis = $this->modele->getSynopsis($this->numFilm);
        
        $this->nbActeur = $this->modele->getNbActeur($this->numFilm);

        $this->note = $this->getNote($this->numFilm);
        
        $this->affiche = $this->getAffiche($this->TitreFilm);
        $this->photo = $this->getPhotos($this->numFilm);
        // 	    $this->galerie = $this->getGalerie(configuration::get("nbImages"));
        
        parent::genererVue();
    }
    
    private function getAffiche($TitreFilm) {
        $affiche = "./image/film/affiche/$TitreFilm.jpg"; // declare le chemin du dossier
        if (!file_exists($affiche)){
           return $affiche = "./image/film/affiche/Aucune affiche.jpg";
        }else{
            return $affiche = "./image/film/affiche/$TitreFilm.jpg";
        }
    }
        
    private function getPhotos($TitreFilm) {
        $dossier = "./image/film/photo/$TitreFilm/"; // declare le chemin du dossier
        if (!file_exists($dossier)){
            return $Photos = "";
        }else{
            return $lesAffiche = glob($dossier.'*.jpg');
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
    
    private function getNote($numFilm){
        $this->listeNote = $this->modele->getNote($this->numFilm);
        $total = 0;
        $i = 0;
        while (!$this->listeNote->estVide()){
            $uneNote = $this->listeNote->getUnElement();
            $total += $uneNote;
            $i += 1;
        };
        $note = ($total/$i);
        return $note;    
    }
    
    
    // 	<a href="./index.php?module=film&page=fiche&section= ".getnumfilm.">...</a>
    
} // class
