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
        $sql = "select count(numActeur) as nbActeur from participer where numFilm = $numFilm;";
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
        $sql = "select prenomPersonne, nomPersonne, dateNaissancePersonne, villeNaissancePersonne, libellePays, getAge(p.dateNaissancePersonne) as agePersonne, participer.role
                from personne as p, pays, participer
                where p.numPaysPersonne = pays.numPays
                AND p.numPersonne = participer.numActeur
                AND numPersonne IN (select numActeur from participer where numFilm = $numFilm);";
        
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
        $sql = "select synopsisFilm from film where numFilm = $numFilm;";
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
        $sql = "select titreFilm from film where numFilm = $numFilm;";
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
        $sql = "select libelleGenre from Genre where Genre.`numGenre`= (select numGenreFilm from film where numFilm = $numFilm);";
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
        $sql = "select libellePays from Pays where numPays = (select numPaysFilm from film where numFilm = $numFilm);";
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
        $sql = "select synopsisFilm from film where numFilm = $numFilm;";
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
        $sql = "select synopsisFilm from film where $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $PositionFilm = $pdoStat->fetchObject();
        return $PositionFilm->PositionFilm;
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
        $sql = "select prenomPersonne from personne where numPersonne = (select numRealisateurFilm from film where numFilm = $numFilm);";
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
        $sql = "select nomPersonne from personne where numPersonne = (select numRealisateurFilm from film where numFilm = $numFilm);";
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
        $sql = "select libellePays from Pays where  numPays = (select numPaysPersonne from Personne where numPersonne = (select numRealisateurFilm from film where numFilm = $numFilm))";
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
        $sql = "select dateSortieFilm from film where numfilm = $numFilm;";
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
        $sql = "select dureeFilm from film where numfilm = $numFilm;";
        $pdoStat = $this->executerRequete($sql);
        $DureeFilm = $pdoStat->fetchObject();
        return $DureeFilm->dureeFilm;
    }
    
    /**
//     * Donne la liste des acteur du film don le numero es donner en parametre
//     * @param null
//     * @return int : le nombre de films
//     * @author Thomasset nathan <nathan.thomasset2@gmail.com>
//     * @version 1.1
//     * @copyright Thomasset Nathan - novenbre 2019
//     */
//     public function getImgFilm($numFilm){
//         $sql = "select synopsisFilm from film where $numFilm;";
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
//         $sql = "select synopsisFilm from film where $numFilm;";
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
//         $sql = "select synopsisFilm from film where $numFilm;";
//         $pdoStat = $this->executerRequete($sql);
//         $Synopsis = $pdoStat->fetchObject();
//         return $Synopsis->Synopsis;
//     }
    
}