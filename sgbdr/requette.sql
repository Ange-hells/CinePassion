use cinepassion38;
select * from film;
select * from participer;
select * from acteur;
select * from personne;
select * from pays;
select * from realisateur;

select numFilm, titreFilm from film order by numFilm;

select count(numActeur)as nbActeur from participer where numFilm = 1;
select prenomPersonne, nomPersonne from personne where numPersonne IN (select numActeur from participer where numFilm = 1 order by numActeur);
select dateNaissancePersonne from personne where numPersonne IN (select numActeur from participer where numFilm = 1 order by numActeur);
select villeNaissancePersonne from personne where numPersonne IN (select numActeur from participer where numFilm = 1 order by numActeur);

select p.prenomPersonne, p.nomPersonne, p.dateNaissancePersonne, p.villeNaissancePersonne, pays.libellePays, getAge(p.dateNaissancePersonne), participer.role
from personne as p, pays, participer
where p.numPaysPersonne = pays.numPays
AND p.numPersonne = participer.numActeur
AND p.numPersonne IN (select numActeur from participer where numFilm = 1 order by numActeur);

Select count(titreFilm) 
from film f, realisateur r, personne p
where r.numRealisateur = f.numrealisateurFilm
and p.numPersonne = r.numRealisateur
;

Select count(titreFilm) 
from film
inner join realisateur
on realisateur.numRealisateur = film.numrealisateurFilm
inner join personne 
on personne.numPersonne = realisateur.numRealisateur
where film.dateSortieFilm <= (select film.dateSortieFilm from film where film.numFilm = 1)
order by film.dateSortieFilm;

select all titreFilm
from film, personne
where film.numRealisateurFilm = (select numRealisateurFilm from film where numfilm = 2);

(select numRealisateurFilm from film where numfilm = 2);

create table notation(
  numFilm int not null primary key,
  note_nathan tinyint,
  note_steph tinyint,
  note_martin tinyint,
  note_antho tinyint,
 CONSTRAINT FK_numFilmNote  FOREIGN KEY (numFilm) REFERENCES film (numFilm)
);

INSERT INTO notation VALUES 
(1, 5, 0, 0, 0),
(2, 0, 0, 0, 0),
(3, 0, 0, 0, 0),
(4, 0, 0, 0, 0),
(5, 0, 0, 0, 0),
(6, 0, 0, 0, 0),
(7, 0, 0, 0, 0),
(8, 0, 0, 0, 0),
(9, 0, 0, 0, 0),
(10, 0, 0, 0, 0),
(11, 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 0, 0, 0, 0),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),
('', 46, 50, 0.25, '1994-11-27'),

