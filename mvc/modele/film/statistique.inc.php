<?php
class modeleFilmStatistique extends modeleFilm{
    
    /**
     * Renvoie le numéro du film à partir de son titre
     * @param string $titreFilm : le titre du film
     * @return integer : le numéro du film
     */
    public function getNbGenre() {
        $sql = "select count(*)as nbGenre from genre;";
        $pdoStat = $this->executerRequete($sql);
        $nbGenre = $pdoStat->fetchObject();
        return $nbGenre->nbGenre;
    }

    public function getGenre() {
        $sql = "select libelleGenre from genre;";
        
        $collection = new collection();
        $pdoStat = $this->executerRequete($sql);
        while(($unGenre = $pdoStat->fetchObject()) !== false){
            $collection->ajouter($unGenre);
        }
        return $collection;
    }
    
    public function getNbFilmParGenre($numGenre) {
        $sql = "select count(titreFilm)as nbFilm from film where numGenreFilm = $numGenre;";
        $pdoStat = $this->executerRequete($sql);
        $nbFilmParGenre = $pdoStat->fetchObject();
        return $nbFilmParGenre->nbFilm;
    }
    
//     public function getNbFilmParGenre($Genre) {
//         $sql = "select count(titreFilm) nbFilm from film where numGenreFilm = (select numGenre from genre where libelleGenre = $Genre);";
//         $pdoStat = $this->executerRequete($sql);
//         $NbFilmParGenre = $pdoStat->fetchObject();
//         return $NbFilmParGenre->nbFilm;
//     }
    
    public function getTotalFilm($debut, $fin) {
        $sql = "select count(titreFilm) nbFilm from film where dateSortieFilm > $debut ;";
        $pdoStat = $this->executerRequete($sql);
        $NbFilmParGenre = $pdoStat->fetchObject();
        return $NbFilmParGenre->nbFilm;
    }
    
}

?>
