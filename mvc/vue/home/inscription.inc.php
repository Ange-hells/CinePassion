<!-- ========= V U E =============================================================================================
fichier				: ./mvc/vue/home/inscription.inc.php
auteur				: Nathan Thomasset (nathan.thomasset2@gmail.com)
date de création	: novenbre 2019
date de modification:
rôle				: permet de générer le code xhtml de la partie centrale de la page d'accueil du module cinepassion38
 ================================================================================================================= -->
    
<div id='content2'>
	<form action="./index.php?module=home&amp;page=inscription" method="post" id='signZone'> 
		<div class="signZone">
    		<div>
        		<input class="signElement" type="text" name="login" placeholder=" login" autocomplete="off"> 
        		<select class="signElement" name="Genre" style="wigth: 169px;">
        			<option>Genre</option>
        			<option>Homme</option>
        			<option>Femme</option>
        			<option>Non-Binaire</option>
        			<option>Agenre</option>
        			<option>BiGenre</option>
        		</select>
    		</div>
    		<br>
    		<div>
        		<input class="signElement" type="text" name="last_name" placeholder=" last name">
        		<input class="signElement" type="text" name="first_name" placeholder=" first name" autocomplete="off">
    		</div>
    		<br>
    		<div>
        		<input class="signElement" type="password" name="passe" placeholder=" password" autocomplete="off">
        		<input class="signElement" type="password" name="passe2" placeholder=" password" autocomplete="off">
    		</div>
    		<br>
    		<div>
        		<input class="signElement" type="email" name="mail" placeholder=" e-mail" autocomplete="off">
        		<input class="signElement" type="email" name="mail" placeholder=" e-mail" autocomplete="off">
    		</div>
    	</div>	
    	<br>
    	<div>
    		<input class="signElement" type="reset" value="Reinitialiser"> 
    		<input class="signElement" type="submit" value="Inscription" href="./index.php?module=home&amp;page=inscription">
    	</div>
		
	</form>
	
	<span class='contentInfos'>
		
	</span>
	<span class='contentInfos'>
		
	</span>
            
	<span class='contentInfos'>
		
	</span>
</div><!-- content2 -->
		    
   