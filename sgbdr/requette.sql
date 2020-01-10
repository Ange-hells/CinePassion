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

select count(titreFilm) as positionFilm
from film, realisateur, personne
where realisateur.numRealisateur = film.numRealisateurFilm
and personne.numPersonne = realisateur.numRealisateur
and film.numRealisateurFilm = (select film.numRealisateurFilm from film where film.numFilm = 2)
and film.dateSortieFilm <= (select film.dateSortieFilm from film where film.numFilm = 2)
order by film.dateSortieFilm;

create table notation(
  numFilm int not null primary key,
  note_nathan tinyint,
  note_steph tinyint,
  note_martin tinyint,
  note_antho tinyint,
 CONSTRAINT FK_numFilmNote  FOREIGN KEY (numFilm) REFERENCES film (numFilm)
);

select note_nathan, note_steph, note_martin, note_antho from notation where numfilm = 1;

INSERT INTO notation VALUES 
(1, 10, 10, 10, 10),
(2, 10, 10, 10, 10),
(3, 10, 10, 10, 10),
(4, 10, 10, 10, 10),
(5, 10, 10, 10, 10),
(6, 10, 10, 10, 10),
(7, 10, 10, 10, 10),
(8, 10, 10, 10, 10),
(9, 10, 10, 10, 10),
(10, 10, 10, 10, 10),
(11, 10, 10, 10, 10),
(12, 10, 10, 10, 10),
(13, 10, 14, 10, 10),
(14, 10, 10, 10, 10),
(15, 10, 16, 10, 10),
(16, 10, 10, 10, 10),
(17, 16, 12, 10, 10),
(18, 10, 10, 10, 10),
(19, 10, 10, 10, 10),
(20, 12, 14, 10, 10),
(21, 10, 10, 10, 10),
(22, 10, 10, 10, 10),
(23, 10, 10, 10, 10),
(24, 10, 10, 10, 10),
(25, 10, 10, 10, 10),
(26, 10, 10, 10, 10),
(27, 12, 14, 10, 10),
(28, 10, 10, 10, 10),
(29, 10, 10, 10, 10),
(30, 10, 10, 10, 10),
(31, 10, 10, 10, 10),
(32, 10, 10, 10, 10),
(33, 18, 10, 10, 10),
(34, 10, 10, 10, 10),
(35, 10, 10, 10, 10),
(36, 10, 13, 10, 10),
(37, 10, 10, 10, 10),
(38, 10, 10, 10, 10),
(39, 10, 10, 10, 10),
(40, 10, 10, 10, 10),
(41, 10, 10, 10, 10),
(42, 10, 10, 10, 10),
(43, 10, 10, 10, 10),
(44, 10, 10, 10, 10),
(45, 10, 10, 10, 10),
(46, 10, 10, 10, 10),
(47, 10, 18, 10, 10),
(48, 10, 10, 10, 10),
(49, 10, 18, 10, 10),
(50, 10, 10, 10, 10),
(51, 10, 10, 10, 10),
(52, 10, 10, 10, 10),
(53, 10, 10, 10, 10),
(54, 10, 10, 10, 10),
(55, 10, 10, 10, 10),
(56, 10, 10, 10, 10),
(57, 10, 10, 10, 10),
(58, 10, 10, 10, 10),
(59, 10, 10, 10, 10),
(60, 10, 10, 10, 10),
(61, 10, 10, 10, 10),
(62, 10, 10, 10, 10),
(63, 10, 18, 10, 10),
(64, 10, 18, 10, 10),
(65, 10, 10, 10, 10),
(66, 10, 14, 10, 10),
(67, 10, 16, 10, 10),
(68, 10, 10, 10, 10),
(69, 10, 10, 10, 10),
(70, 10, 10, 10, 10),
(71, 10, 10, 10, 10),
(72, 10, 10, 10, 10),
(73, 8, 10, 10, 10),
(74, 10, 10, 10, 10),
(75, 10, 10, 10, 10),
(76, 10, 10, 10, 10),
(77, 10, 10, 10, 10),
(78, 10, 16, 10, 10),
(79, 10, 14, 10, 10),
(80, 10, 10, 10, 10),
(81, 10, 10, 10, 10),
(82, 10, 10, 10, 10),
(83, 10, 10, 10, 10),
(84, 10, 14, 10, 10),
(85, 10, 12, 10, 10),
(86, 10, 16, 10, 10),
(87, 10, 10, 10, 10),
(88, 10, 10, 10, 10),
(89, 10, 10, 10, 10),
(90, 10, 10, 10, 10),
(91, 10, 10, 10, 10),
(92, 10, 10, 10, 10),
(93, 10, 16, 10, 10),
(94, 10, 10, 10, 10),
(95, 10, 10, 10, 10),
(96, 10, 10, 10, 10),
(97, 14, 10, 10, 10),
(98, 10, 10, 10, 10),
(99, 10, 10, 10, 10),
(100, 10, 10, 10, 10),
(101, 10, 20, 10, 10),
(102, 10, 10, 10, 10),
(103, 10, 10, 10, 10),
(104, 10, 10, 10, 10),
(105, 10, 10, 10, 10),
(106, 10, 16, 10, 10),
(107, 10, 10, 10, 10),
(108, 10, 10, 10, 10),
(109, 10, 10, 10, 10),
(110, 10, 16, 10, 10),
(111, 10, 10, 10, 10),
(112, 10, 12, 10, 10),
(113, 10, 12, 10, 10),
(114, 10, 8, 10, 10),
(115, 10, 10, 10, 10),
(116, 10, 10, 10, 10),
(117, 10, 10, 10, 10),
(118, 20, 18, 10, 10),
(119, 10, 10, 10, 10)
