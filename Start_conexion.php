<?php   

	$link = mysqli_connect('localhost', 'etudiant_db', 'Z3sg2ewAA9W2');
	mysqli_set_charset($link, "utf8mb4");
	mysqli_select_db($link, 'oiseaudb') or die('Impossible de sélectionner la BDD oiseaudb : '. mysqli_error($link));
    

