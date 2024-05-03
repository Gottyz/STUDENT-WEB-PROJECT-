<?php 
//PROCEDURE QUI CREE UN TABLEAU HTML A PARTIR d'un tableau php 
// ex : creerTabHTML($tab,$nbcol,$nblig,$t)
// paramètre à saisir : 
	// $tab : le tableau
	// $nbcol : nb de colonnes
	// $nblig : nb de lignes 
	// $t tableau de titres (1 ligne) - saisir NULL pour ne pas aficher de titre

function creerTabHTML($tab,$nbcol,$nblig,$t)
{
	echo "<CENTER><TABLE BORDER = 1>";				// début du tableau
	
	if (isset($t)==TRUE)							// on teste l'existence de $t
	{
		echo "<THEAD>";								// crée l'en-tête du tableau avce les noms des champs de la requête
		echo "<TR>";
		for ($i=0; $i < $nbcol; $i++)				//boucle parcourant chaque colonne du recordset, 
		{
			echo "<TH>" . $t[$i] . "</TH>";			// affichage de la ligne d'entête
		} 
		echo "</TR>";
		echo "</THEAD>";
	}
	
	echo "<TBODY>";									// crée le corps du tableau
		for ($i=0; $i < $nblig; $i++)				//boucle parcourant chaque colonne du recordset, 
		{
			echo ("<TR>");
			for ($j=0; $j < $nbcol; $j++)			//boucle parcourant chaque colonne du recordset
			{
					echo "<TD>" . $tab[$i][$j]  . "</TD>";	// affichage des valeurs du tableau
			}
			echo "</TR>";
		}
	echo "</TBODY>";
	echo "</TABLE></CENTER>";
}

?>