
<?php 
    
    $result = mysqli_query($link, $query);
    mysqli_free_result($result);
    mysqli_close($link);
    
?>