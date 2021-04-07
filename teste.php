<?php 
    $teste = "aaa";
    $teste = filter_var($teste, FILTER_VALIDATE_INT);
    if($teste === false)
        echo "FALSO";
    else
        echo "VERDADEIRO";
?>