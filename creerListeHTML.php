<?php 
//PROCEDURE QUI CREE UNE liste HTML A PARTIR d'un tableau php 
// ex : creerListeHTML($name,$tab)
// paramètres à saisir : 
    // $name : le nom de la liste
    // $tab : tableau à 2 colonnes contenant : 
        // le value (l'identifiant pour le système)
        // le texte à afficher dans la liste pour l'utilisateur 
function creerListeHTML($name,$tab,$select)
{
    echo "<select name =" . $name . ">";
    echo PHP_EOL; // crée un retour de ligne dans le code HTML, utile en debogage / à tester en l'oubliant !
    for ($i=0; $i < count($tab); $i++){
        if ($select == $tab[$i][0])         // Si para el valor de la selección, el valor de la tabla es el mismo
            echo "<option selected value = '" .$tab[$i][0]."'>" . $tab[$i][1] ." </option> "; // Mostrar la selección y dejarla
        else 
            echo "<option value = '" .$tab[$i][0]."'>" . $tab[$i][1] ." </option> "; // o si no mostrar la primera por defecto
        echo PHP_EOL;
    }
    echo "</select>";
}

