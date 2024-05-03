<?php
// Ruta al archivo JSON
$jsonFilePath = '/Users/gottyz/Desktop/Technologies du web/Projet_Oiseaux /Données_Climatologiques_swagger.json';

// Cargar y decodificar el archivo JSON
$data = json_decode(file_get_contents($jsonFilePath), true);

if ($data) {
    // Los datos se han cargado y decodificado correctamente
    echo '<h1>Datos cargados desde JSON</h1>';
    echo '<pre>';
    print_r($data);
    echo '</pre>';
} else {
    // Error al cargar o decodificar el JSON
    echo 'Error al cargar los datos desde JSON.';
}
?>

