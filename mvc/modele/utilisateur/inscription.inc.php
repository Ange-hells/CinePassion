<?php
class modeleUtilisateurInscription extends modele{
    /**
     * Renvoie tous les films de la cinémathèque
     * @param null
     * @return collection : une collection d'objets anonymes contenant les informations sur les films (n°, titre, durée, année de
     sortie, genre, prénom et nom du réalisateur)
     */
//     public function getListeFilms() {
        
//         $sql = "SELECT film.numFilm, film.titreFilm, genre.libelleGenre, YEAR(film.dateSortieFilm) as annee, TIME_FORMAT(film.dureeFilm, '%H:%i') as duree, p.nomPersonne as nomReal, p.prenomPersonne as prenomReal
// 				FROM film , genre , personne p
//       			WHERE genre.numGenre = film.numGenreFilm
// 				AND film.numRealisateurFilm = p.numPersonne
//   				ORDER BY titreFilm ASC;";
        
//         $collection = new collection();
//         $pdoStat = $this->executerRequete($sql);
//         while(($unFilm = $pdoStat->fetchObject()) !== false){
//             $collection->ajouter($unFilm);
            
//         }
//         return $collection;
        
//     }
    
}