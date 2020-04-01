<?php
/* Fonction sans parametres qui renvoi un <p> avec la date du jour.*/
function getTheDate(){
	$jour = date('d');
	$mois = date('m');
	$annee = date('Y');
	$heure = date('H');
	$minutes = date('i');
	$jours_de_semaine = array('Dimanche' , 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi');
	$jour_de_semaine = date('w');

	$date = '<p>'. $jours_de_semaine[$jour_de_semaine]. '/' . $jour . '/' .$mois . '/' .$annee. '</p>';
	return $date;
}