
<?php

// Inclusión del archivo de inicio de conexión a la base de datos
include("Start_conexion.php");

if ($observateur && $dpt) { // and = $&&
// Consulta SQL para obtener las observaciones
$query = "SELECT o.nom_commun, SUM(obs.nombre) as quantite 
          FROM Observations obs
          JOIN oiseaux o ON obs.id_oiseau = o.id_oiseau
          JOIN Communes c ON obs.id_commune = c.id_commune
          WHERE obs.id_observateur = $observateur AND c.id_dpt = $dpt
          GROUP BY o.nom_commun";

$result = mysqli_query($link, $query);				// Ejecutar la consulta SQL y manejar errores

if (!$result) {
    die("Error en la consulta SQL: " . mysqli_error($link));			    // Si la consulta falla, mostrar un mensaje de error y terminar el script

}
                                    
                                //// Obtener el valor máximo de la columna 'quantite' 
$max_quantite= 0;									// Inicializar la variable para almacenar el valor máximo de la columna 'quantite'			
while ($row = mysqli_fetch_array($result)) {			// Inicializar la variable para almacenar el valor máximo de la columna 'quantite'
    $quantite =	intval($row['quantite']);
    if ($quantite > $max_quantite)  {
        $max_quantite= $quantite;
    }
}	
                                                            // Reiniciar el puntero de resultados para volver a comenzar desde el principio

    mysqli_data_seek($result, 0);
    
                                                        // Si hay resultados, mostrar una tabla con los datos, destacando el valor máximo en rojo

if (mysqli_num_rows($result) > 0) {
    echo "<table border='2'>";
    echo "<tr><th>Oiseau</th><th>Quantité</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        $quantite= intval($row['quantite']);
        $color = ($quantite == $max_quantite) ? 'color : red' :'';
        echo "<tr><td>" . ($row['nom_commun']) . "</td><td style='$color'>" . ($row['quantite']) . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron observaciones para el observador y departamento seleccionados.";
}
}
                                                        // Inclusión del archivo de final de conexión a la base de datos
include("Finish_conexion.php");
?>
</p>
</tr>
</div>