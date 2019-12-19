<?php 
class modelelistefilm extends modeleFilm{
    private $section;
    private $nbSections;
    
    /**
     * Renvoie tous les films de la cinémathèque
     * @param null
     * @return collection : une collection d'objets anonymes contenant les informations sur les films (n°, titre, durée, année de
     sortie, genre, prénom et nom du réalisateur)
     */
    public function getListeFilms($debut, $nb) {
        
        $sql = "SELECT film.numFilm, film.numFilm, film.titreFilm, genre.libelleGenre, YEAR(film.dateSortieFilm) as annee, TIME_FORMAT(film.dureeFilm, '%H:%i') as duree, p.nomPersonne as nomReal, p.prenomPersonne as prenomReal                      
				FROM film , genre , personne p
      			WHERE genre.numGenre = film.numGenreFilm
				AND film.numRealisateurFilm = p.numPersonne
  				ORDER BY titreFilm ASC
                LIMIT $debut, $nb;";

        $collection = new collection();
        $pdoStat = $this->executerRequete($sql);
        while(($unFilm = $pdoStat->fetchObject()) !== false){
            $collection->ajouter($unFilm);
            
        }
        return $collection;
        
    }
    
//     public function getSectionCourante(){
//         //($this->section < $this->nbSections) ? ($this->section < 1) ? $this->section = 1 : $this->section : $this->section = $this->nbSections;
//         if ($this->section < $this->nbSections){
//             $sectionCourante = $this->section;
//         }elseif ($this->section < 1){
//             $sectionCourante=$this->section = 1;
//         }else {
//             $sectionCourante=$this->section = $this->nbSections;
//         }
//         return $sectionCourante;
//     }
}