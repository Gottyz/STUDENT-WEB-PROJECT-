 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title>Oiseaux - Projet Techno. Web</title>
    <link rel="stylesheet" type="text/css" href="styles/maFeuilleDeStyle.css" media="all" />
</head>
<body>

<div id="global">



    <!-- Inclusión de archivos HTML para el encabezado, la creación de listas HTML, la navegación, etc. -->
    <?php include("DIVEntete.html"); ?>
    <?php include("creerListeHTML.php"); ?>
    <?php include("DIVNavigation.html"); ?>
    <?php include ("creerTabHTML.php"); ?>

    <div id="contenu">
        <h3>Répartition des observations d'oiseaux par observateur et par département.</h3>

        <form action="Observation.php" method="GET" />

            Choisissez un observateur :<br /><br />
        <?php

            include("Start_conexion.php");

            $query = 'SELECT o.id_observateur, o.nom_observateur 
					FROM Observations obs 
					INNER JOIN observateurs o 
					ON o.id_observateur = obs.id_observateur 
					GROUP BY o.nom_observateur ';

        $result = mysqli_query($link,$query);			//// Ejecutar la consulta SQL y almacenar el resultado en la variable $result
        $tab = mysqli_fetch_all($result);				// Obtener todas las filas del resultado como una matriz y almacenarlas en la variable $tab

            $observateur = isset($_GET["Liste_obs"]) ? $_GET["Liste_obs"] : null ;																			 // Creación de una lista desplegable para los observadores
            creerListeHTML("Liste_obs", $tab, $observateur);

            include("Finish_conexion.php");
        ?>
            <input type="submit" name="bt_submit_obs" value="Afficher" /><br />


                <!-- Si se hace clic en el botón para mostrar las observaciones -->
        <?php

        if (isset($_GET["bt_submit_obs"]) || isset($_GET["bt_submit_dpt"])) {

            echo "<br> Sélectionner un département : <br/> <br>";

            echo '<form action="Observation.php"  method= "GET" name= "form_dpt" />';
            // Inclusión del archivo de inicio de conexión a la base de datos
            include("Start_conexion.php");

            // Consulta SQL para obtener los departamentos
            $query = "SELECT id_dpt, nom_dpt FROM Departements";
            $result = mysqli_query($link, $query);
            $tab = mysqli_fetch_all($result);

            $dpt = isset($_GET["Liste_dpt"]) ? $_GET["Liste_dpt"] : null; 				// Creación de una lista desplegable para los departamentos
            creerListeHTML("Liste_dpt", $tab, $dpt );

            // Inclusión del archivo de final de conexión a la base de datos
            include("Finish_conexion.php");

            // variable para poder crear el boton contenido en el boton "hidden"

            echo '<input type="hidden"  name="Liste_obs"  value="'.$observateur.'" </br>'; // Boton que me permite mostrar la tabla
            echo '<input type="submit" name="bt_submit_dpt" value="Afficher" />';

        }
        ?>
        <table class="miTabla">
            <p> <?php include("tableau_observation.php");?> </p>
        </table>
        </form>
        </div>
        <td>

        <?php include("DIVPied.html"); ?>
        </td>

    </div>
</body>
</html>