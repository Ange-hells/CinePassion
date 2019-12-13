<!-- ========= V U E =============================================================================================
fichier				: ./mvc/vue/film/fiche.inc.php
auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
date de création	: Octobre 2019
date de modification:
rôle					: permet de générer le code xhtml de la partie centrale de la page d'accueil du module cinepassion38
 ================================================================================================================= -->
    
<div id='content2'>
		<div id="onglet">
            <input type="radio" id="information" name="box" checked />
            <label for="information">Information 
            	<div class="contenu">
            		<p>
                		<?php echo $TitreFilm;?> et le ?php echo $PositionFilm;? film dans notre cinématheque du réalisateur <?php echo $PaysReal." ". 
                		$PrenomReal." ". $NomReal;?>. 
                		C'est un film <?php echo $GenreFilm." ". $PaysFilm;?> d'une duree de <?php echo $DureeFilm;?> qui est sorti dans les salles de cinéma 
                		en france le <?php echo $DateSortie;?>.
                		
            		</p>
            	</div>
            </label>
            
            <input type="radio" id="histoire" name="box" />
        	<label for="histoire">Histoire
            	<div class="contenu">
                	<p>
                		<?php echo $Synopsis; ?>
                	</p>
            	</div>
            </label>
            
            <input type="radio" id="acteurs" name="box" />
            <label for="acteurs">Acteurs
            	<div class="contenu">
            		<?php 
            		if ($nbActeur == 0){
            		    echo "Aucun acteur n'est actuellement référencé pour ce film dans notre base de données.";
            		}else{
                        echo "<div id='listeActeur'>";
                        while (!$listeActeur->estVide()){
                            $unActeur = $listeActeur-> getUnElement();
                            
                            echo "<div id='ficheActeur'>";
                                if (file_exists("./././image/personne/acteur/$unActeur->prenomPersonne $unActeur->nomPersonne.jpg")){
                                       echo " <img class='element1' src='./././image/personne/acteur/$unActeur->prenomPersonne $unActeur->nomPersonne.jpg'>";
                                }else{
                                    echo" <img class='element1' src='./././image/personne/Aucune personne.jpg'>";
                                };
                                echo "<p class='element2'> $unActeur->prenomPersonne $unActeur->nomPersonne </br> $unActeur->age ans </br> né le $unActeur->dateNaissance </br> a $unActeur->villeNaissance </br> $unActeur->paysNaissance </p>";        
                                echo "<p class='element3'>"; if ($unActeur->sexe == 'M'){
                                                                echo "Dans ce film, $unActeur->prenomPersonne $unActeur->nomPersonne joue le role de $unActeur->role il etais agé de $unActeur->ageDansFilm ans lors de la sorti du film en France.</p>";
                                                            }else{
                                                                echo "Dans ce film, $unActeur->prenomPersonne $unActeur->nomPersonne joue le role de $unActeur->role elle etais agée de $unActeur->ageDansFilm ans lors de la sorti du film en France.</p>";       
                                                            };
                            echo "</div>";
             		    };
                	   echo"</div>";
            		};
            		?>
            	
            	</div>
            </label>
            
            <input type="radio" id="notation" name="box" />
            <label for="notation">Notation
           		<div class="contenu">
           			<?php 
           			  echo "pour $TitreFilm la note moyenne atribuer par CinePassion38 et de $note / 20";
           			?>
           		</div>
            </label>
            
            <input type="radio" id="commentaires" name="box" />
            <label for="commentaires">Commentaires
            	<div class="contenu">
            		Commentaire à propos de ce film
            	
            	</div>
            </label>
        </div>

	<span class='contentInfos'>
		
	</span>
            
	<span class='contentInfos'>
		
	</span>
</div><!-- content2 -->