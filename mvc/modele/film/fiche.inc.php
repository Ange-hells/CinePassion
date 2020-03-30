<?php 
class modeleFilmFiche extends modeleFilm{
    private $numFilm;
    private $Synopsis;
    
    /**
     * Donne le Nombre d'acteur du film don le numero es passer en parametre
     * @param numFilm
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - Novembre 2019
     */
    public function getNbActeur($numFilm){
        $sql = "SELECT count(numActeur) as nbActeur FROM participer WHERE numFilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $nbActeur = $pdoStat->fetchObject();
        return $nbActeur->nbActeur;
    }
    
    /**
     * Donne la liste des acteur (ainsi que leur information) du film don le numero es passer en parametre
     * @param numFilm
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - Novembre 2019
     */
    public function getListeActeur($numFilm){
        $sql = "SELECT getAge(p.dateNaissancePersonne) as age, getNbAnneesEcart(p.dateNaissancePersonne, f.dateSortieFilm) as ageDansFilm, DATE_FORMAT(p.dateNaissancePersonne, '%d %M %Y') as dateNaissance,
                p2.libellePays as paysNaissance, p.prenomPersonne, p.nomPersonne, p1.role as role, sexepersonne as sexe, villeNaissancePersonne as villeNaissance
                FROM personne p, acteur a,film f, participer p1, pays p2
                WHERE a.numActeur = p.numPersonne
                AND p1.numActeur = a.numActeur
                AND p1.numFilm=f.numFilm
                AND p.numPaysPersonne = p2.numPays
                AND f.numFilm = '" . $numFilm . "';";
        
        $collection = new collection();
        $pdoStat = $this->executerRequete($sql);
        while(($unActeur = $pdoStat->fetchObject()) !== false){
            $collection->ajouter($unActeur);
        }
        return $collection;
    }
    
    /**
     * Donne le Synopsis du film don le numero es passer en parametre
     * @param numFilm
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - Novembre 2019
     */
    public function getSynopsis($numFilm){
        $sql = "SELECT synopsisFilm FROM film WHERE numFilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $Synopsis = $pdoStat->fetchObject();
        return $Synopsis->synopsisFilm;
    }
    
    
    /**
     * Donne le titre du film don le numero es donner en parametre
     * @param numFilm
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - Novenbre 2019
     */
    public function getTitreFilm($numFilm){
        $sql = "SELECT titreFilm FROM film WHERE numFilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $TitreFilm = $pdoStat->fetchObject();
        return $TitreFilm->titreFilm;
    }
    
    /**
     * Donne le genre du film don le numero es donner en parametre
     * @param null
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - Novenbre 2019
     */
    public function getGenre($numFilm){
        $sql = "SELECT libelleGenre FROM genre WHERE genre.`numGenre`= (SELECT numGenreFilm FROM film WHERE numFilm = $numFilm);";
        $pdoStat = $this->executerRequete($sql);
        $GenreFilm = $pdoStat->fetchObject();
        return $GenreFilm->libelleGenre;
    }
    
    /**
     * Donne le pays du film don le numero es donner en parametre
     * @param null
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - novenbre 2019
     */
    public function getPays($numFilm){
        $sql = "SELECT libellePays FROM pays WHERE numPays = (SELECT numPaysFilm FROM film WHERE numFilm = $numFilm);";
        $pdoStat = $this->executerRequete($sql);
        $PaysFilm = $pdoStat->fetchObject();
        return $PaysFilm->libellePays;
    }
    
    /**
     * Donne la liste des acteur du film don le numero es donner en parametre
     * @param null
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - novenbre 2019
     */
    public function getActeurs($numFilm){
        $sql = "SELECT synopsisFilm FROM film WHERE numFilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $ActeurFilm = $pdoStat->fetchObject();
        return $ActeurFilm->Acteurs;
    }
    
    /**
     * Donne la liste des acteur du film don le numero es donner en parametre
     * @param null
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - novenbre 2019
     */
    public function getPosition($numFilm){
        $sql = "SELECT count(titreFilm) as positionFilm
                FROM film, realisateur, personne
                WHERE realisateur.numRealisateur = film.numRealisateurFilm
                AND personne.numPersonne = realisateur.numRealisateur
                AND film.numRealisateurFilm = (SELECT film.numRealisateurFilm FROM film WHERE film.numFilm = 2)
                AND film.dateSortieFilm <= (SELECT film.dateSortieFilm FROM film WHERE film.numFilm = 2)
                ORDER BY film.dateSortieFilm;";
        
        $pdoStat = $this->executerRequete($sql);
        $PositionFilm = $pdoStat->fetchObject();
        if ($PositionFilm->positionFilm == 1){
            $PositionFilm = "1<sup>er</sup>";
            
        }else{
            $PositionFilm = "$PositionFilm->positionFilm<sup>�me</sup>";
        }
        
        return $PositionFilm;
    }

    /**
     * Donne la liste des acteur du film don le numero es donner en parametre
     * @param null
     * @return int : le nombre de films
     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
     * @version 1.1
     * @copyright Thomasset Nathan - novenbre 2019
     */
    public function getPrenomReal($numFilm){
        $sql = "SELECT prenomPersonne FROM personne WHERE numPersonne = (SELECT numRealisateurFilm FROM film WHERE numFilm = $numFilm);";
        $pdoStat = $this->executerRequete($sql);
        $PrenomReal = $pdoStat->fetchObject();
        return $PrenomReal->prenomPersonne;
    }
    
    
    /**
    * Donne la liste des acteur du film don le numero es donner en parametre
    * @param null
    * @return int : le nombre de films
    * @author Thomasset nathan <nathan.thomasset2@gmail.com>
    * @version 1.1
    * @copyright Thomasset Nathan - novenbre 2019
    */
    public function getNomReal($numFilm){
        $sql = "SELECT nomPersonne FROM personne WHERE numPersonne = (SELECT numRealisateurFilm FROM film WHERE numFilm = $numFilm);";
        $pdoStat = $this->executerRequete($sql);
        $NomReal = $pdoStat->fetchObject();
        return $NomReal->nomPersonne;
    }
    
    /**
    * Donne la liste des acteur du film don le numero es donner en parametre
    * @param null
    * @return int : le nombre de films
    * @author Thomasset nathan <nathan.thomasset2@gmail.com>
    * @version 1.1
    * @copyright Thomasset Nathan - novenbre 2019
    */
    public function getPaysReal($numFilm){
        $sql = "SELECT libellePays FROM pays WHERE  numPays = (SELECT numPaysPersonne FROM personne WHERE numPersonne = (SELECT numRealisateurFilm FROM film WHERE numFilm = $numFilm))";
        $pdoStat = $this->executerRequete($sql);
        $PaysReal = $pdoStat->fetchObject();
        return $PaysReal->libellePays;
    }
    
    /**
    * Donne la liste des acteur du film don le numero es donner en parametre
    * @param null
    * @return int : le nombre de films
    * @author Thomasset nathan <nathan.thomasset2@gmail.com>
    * @version 1.1
    * @copyright Thomasset Nathan - novenbre 2019
    */
    public function getDateSortie($numFilm){
        $sql = "SELECT DATE_FORMAT(dateSortieFilm, '%d %M %Y') as dateSortieFilm FROM film WHERE numfilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $DateSortie = $pdoStat->fetchObject();
        return $DateSortie->dateSortieFilm;
    }
    
    /**
    * Donne la liste des acteur du film don le numero es donner en parametre
    * @param null
    * @return int : le nombre de films
    * @author Thomasset nathan <nathan.thomasset2@gmail.com>
    * @version 1.1
    * @copyright Thomasset Nathan - novenbre 2019
    */
    public function getDureeFilm($numFilm){
        $sql = "SELECT dureeFilm FROM film WHERE numfilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $DureeFilm = $pdoStat->fetchObject();
        return $DureeFilm->dureeFilm;
    }
    
    public function getNote($numFilm){
        $sql = "SELECT note_nathan, note_steph, note_martin, note_antho FROM notation WHERE numfilm = $numFilm;";
        
//         $collection = new collection();
        $pdoStat = $this->executerRequete($sql);
        $listeNote = $pdoStat->fetchObject();
        $total = ($listeNote->note_nathan + $listeNote->note_steph + $listeNote->note_martin + $listeNote->note_antho);
        return $total/4;
    }
    
    /**
    * Donne la liste des acteur du film don le numero es donner en parametre
    * @param null
    * @return int : le nombre de films
    * @author Thomasset nathan <nathan.thomasset2@gmail.com>
    * @version 1.1
    * @copyright Thomasset Nathan - novenbre 2019
    */
//     public function getImgFilm($numFilm){
//         $sql = "SELECT synopsisFilm FROM film WHERE $numFilm;";
//         $pdoStat = $this->executerRequete($sql);
//         $Synopsis = $pdoStat->fetchObject();
//         return $Synopsis->Synopsis;
//     }
    
//     /**
//     * Donne la liste des acteur du film don le numero es donner en parametre
//     * @param null
//     * @return int : le nombre de films
//     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
//     * @version 1.1
//     * @copyright Thomasset Nathan - novenbre 2019
//     */
//     public function getImgFilm($numFilm){
//         $sql = "SELECT synopsisFilm FROM film WHERE $numFilm;";
//         $pdoStat = $this->executerRequete($sql);
//         $Synopsis = $pdoStat->fetchObject();
//         return $Synopsis->Synopsis;
//     }
    
//     /**
//     * Donne la liste des acteur du film don le numero es donner en parametre
//     * @param null
//     * @return int : le nombre de films
//     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
//     * @version 1.1
//     * @copyright Thomasset Nathan - novenbre 2019
//     */
//     public function getImgFilm($numFilm){
//         $sql = "SELECT synopsisFilm FROM film WHERE $numFilm;";
//         $pdoStat = $this->executerRequete($sql);
//         $Synopsis = $pdoStat->fetchObject();
//         return $Synopsis->Synopsis;
//     }
    
}