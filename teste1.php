<?php
// Created function exemples impar numbers and show it with imput number between 1 and 10
function impares($num){
    $impares = [];
    for ($i = 0; $i < $num; $i++){
        if ($i % 2 != 0){
            $impares[] = $i;
        }
    }
    return $impares;
}

?>
<form>
    <p>Choisissez un nombre:</p>
    <label>
        <input type="text" style="text-align: center;" size= "5" name="nombre" value="<?php echo isset($_GET['nombre']) ? ($_GET['nombre']) : null ; ?>" >
    </label>
    <input type='submit' value='Valider' name='name'>
    <?php if (isset($_GET["nombre"])): ?>
        <i> <h4><p>Les nombres impairs entre 1 et <?php echo ($_GET['nombre']); ?> sont: </h4></i>
        <?php
        $impares = impares($_GET['nombre']);
        foreach ($impares as $impar){
            echo "$impar ";
        }
        ?>
        </p>
    <?php endif; ?>
</form>
</body>
</html>


