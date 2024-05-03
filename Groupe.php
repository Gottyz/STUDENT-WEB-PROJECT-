
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
    <title> Oiseaux - Projet Techno. Web</title>
    <link rel="stylesheet" type="text/css" href="styles/maFeuilleDeStyle.css" media="all" />
</head>
<body>

<div id="global">
    
    <?php include("DIVEntete.html"); ?>
    <?php include("DIVNavigation.html"); ?>
    <?php include("creerListeHTML.php"); ?>
    <?php include("creerTabHTML.php"); ?>
    <?php include("Start_conexion.php"); ?>

    <div id="contenu" />
        <h3>Répartition des observations d'oiseaux par département</h3>

        <form action="Groupe.php" method="GET" />

        <p>Choisissez un département :</p>

        <?php

        $query = "SELECT * FROM Departements";
        $result = mysqli_query($link, $query);
        $tab = mysqli_fetch_all($result);

        $dpt = isset($_GET["Liste_dpt"]) ? $_GET["Liste_dpt"]: null;
        creerListeHTML("Liste_dpt", $tab, $dpt);
        include("Finish_conexion.php");

        ?>

        <form/>

            <p>Choisissez un trimestre:</p>

            <select name="trimestre">
                <?php foreach (["1er trimestre","2ème trimestre","3ème trimestre","4ème trimestre"] as $trimestre): ?>
                    <option value="<?php echo $trimestre; ?>"><?php echo $trimestre ; ?></option>
                <?php endforeach; ?>
               </select>
</body>




<p>Choisissez la taille minimale d’un groupe:</p>

<label>
    <input type="text" style="text-align: center;" size= "5" name="nombre" value="<?php echo isset($_GET['nombre']) ? ($_GET['nombre']) : null ; ?>" >
</label>
<input type='submit' value='Valider' name='name'>
<?php if (isset($_GET["nombre"])): ?>

    <?php
    // Conexión a la base de datos
    include("Start_conexion.php");

    // Recuperar los valores seleccionados
    $departamento = $_GET['Liste_dpt'];
    $trimestre = array_search($_GET['trimestre'], ["1er trimestre","2ème trimestre","3ème trimestre","4ème trimestre"]) + 1;
    $minimo = $_GET['nombre'];

    // Consulta SQL para contar las observaciones
    $query = "SELECT COUNT(*) AS num_observaciones
              FROM Observations O
              JOIN Communes C ON O.id_commune = C.id_commune
              JOIN Departements D ON C.id_dpt = D.id_dpt
              JOIN oiseaux Oi ON O.id_oiseau = Oi.id_oiseau
              WHERE D.id_dpt = '$departamento' AND O.nombre >= $minimo AND QUARTER(O.date) = $trimestre";

    // Ejecutar la consulta
    $result = mysqli_query($link, $query);

    // Recuperar el número de observaciones
    $row = mysqli_fetch_assoc($result);
    $num_observaciones = $row['num_observaciones'];

    // Cerrar la conexión a la base de datos
    include("Finish_conexion.php");
    ?>

    <i> <h4><p>Bilan des <?php echo $num_observaciones; ?> observations faites dans le département <?php echo ($_GET['Liste_dpt']); ?>
                durant le <?php echo ($_GET['trimestre']); ?> par groupe d'au moins <?php echo ($_GET['nombre']); ?> individus.</h4></i>
    </p>

    <p> Le [], [] individus de [] ont été observés à [] </p>

<?php endif; ?>




</div><!-- #contenu -->

    <?php include("DIVPied.html"); ?>


</div><!-- #global -->

</body>
</html>