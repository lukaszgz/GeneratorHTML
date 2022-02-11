<?php 
    session_start();

    $fold = "uploads/" . $_SESSION['folder'] . "/*";
    
    echo $fold . "</br>";
    
    if(array_map('unlink', glob($fold)))
        echo "<script> window.close(); </script>";
    else
        echo "<strong>COŚ POSZŁO ŹLE - OPERACJA NIE POWIODŁA SIĘ!";
?>