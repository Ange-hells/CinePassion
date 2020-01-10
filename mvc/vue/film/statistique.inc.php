<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/film/accueil.inc.php
 auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
 date de création	: septembre 2019
 date de modification:
 rôle					: permet de générer le code xhtml de la partie centrale de la page d'accueil du module cinepassion38
 ================================================================================================================= -->
<div id='content2'>
   <div id="statOnglet">
        <input type="radio" id="annee" name="box" checked />
        <label for="annee">nb films/année
        	<div class="contenu">
        		<p class='stat'> la cinémathèque est composée de <?php echo $nbFilmTotal;?> films pour la periode <?php echo $periode;?></p>
        		<div class='conteneur'>
            		<?php 
//                 		while (!$genre->estVide()){
//                 		    $unGenre = $genre-> getUnElement();
                		    
//                             echo"<div class='block'>";
//                                 echo"<div class='top'>";
//                                     echo $unGenre->libelleGenre;
//                                 echo"</div>";
//                             echo"<div class='bottom'>";
//                                 echo"10";
// //                                     echo $this->modele->getNbFilmParGenre($unGenre);
//                                 echo"</div>";
//                             echo"</div>";
//                 		};
            		?>
            	</div>
        			
        			
        	</div>
        </label>
        <input type="radio" id="genre" name="box" />
        <label for="genre">nb films/genre
        	<div class="contenu">
        		<p class='stat'> la cinémathèque est composée de <?php echo $nbFilms;?> films répartis en <?php echo $nbGenre;?> genres</p>
        		<div class='conteneur'>
            		<?php 
            		while (!$genre->estVide()){
                		    $unGenre = $genre-> getUnElement();

                            echo"<div class='block'>";
                                echo"<div class='top'>";
                                    echo $unGenre->libelleGenre;
                                echo"</div>";
                            echo"<div class='bottom'>";
                                echo"10";
//                                     echo $this->modelegetNbFilmParGenre($unGenre);
                                echo"</div>";
                            echo"</div>";
                		};
                        
                		
                		
                		
// ===============================================================================================================================================
//        !!! SOLUTION INFONCTIONNELLE MAIS TOTALEMENT LOGIQUE !!!         		
// ===============================================================================================================================================                		
//                 		for($i=0; $i<=$nbGenre; $i++){
//                 		    echo"<div class='block'>";
//                 		      echo"<div class='top'>";
//                 		      echo $this->modele->getGenre($i); //execute la fonction getGenre du modele avec pour parametre $i. retourne le genre dont le numGenre est $i.
//                 		      echo"</div>";
//                 		      echo"<div class='bottom'>";
//                 		          echo"10";
//                 		          echo $this->modele->getNbFilmParGenre($i); //execute la fonction getNbFilmParGenre du modele avec pour parametre $i. retourne le nombre de film dont le numGenre est $i.
//                 		      echo"</div>";
//                 		    echo"</div>";
                		    
//                 		};

            		?>
            	</div>
        	</div>
        </label>
	</div>

	<span class='contentInfos'>
		
	</span>
</div><!-- content2 -->


