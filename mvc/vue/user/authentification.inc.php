<!-- ========= V U E =============================================================================================
 fichier				: ./mvc/vue/cinepassion38/authentification.inc.php
 auteur					: Lucie et Lina
 date de création		: juin 2017
 date de modification	:
 rôle					: permet de générer le code xhtml de la partie centrale de la page d'accueil du module cinepassion38
 ================================================================================================================= -->
<div id='content2'>
 
<?php 
if(!isset($_SESSION['Utilisateur'])) {
	?>
	<img src='./image/divers/ko.png' height="50px" width="50px">
	<?php 
	echo " Echec de la tentative d'authentification";
	?>
	<ul>
		<li>Votre tentative d'authentification est en échec. Votre identifiant et/ou votre mot de passe sont incorrects.</li>
		<li>Vérifiez les informations saisies et essayez à nouveau.</li>
	</ul>
<?php 
}else {
	?>
	<img src='./image/divers/ok.png' height="50px" width="50px">
	<?php 
	echo "Authentification réalisée avec succès";
	}?>
	<ul>
		<li>C'est votre 2ème connexion depuis la création de votre compte le vendredi 15 décembre 2017.</li>
		<li>Votre dernière connexion a eu lieu le jeudi 29 mars 2018 à 14 heures et 21 minutes.</li>
		<li>Vous n'avez pas encore modifié votre mot de passe. Pour des raisons de sécurité, pensez à le faire rapidement. Vous pouvez le modifier ici.</li>
	</ul>
	

</div><!-- content2 -->