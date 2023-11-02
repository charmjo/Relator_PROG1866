<?php
    $a = [10, 20, 30, 40, 50, 'yeet'];

    $a[] = 'hi2'; 
    $b = $a;
    
    
    for ($i=0; $i < count($a); $i++) { 
        echo $a[$i];
        echo '<br>';
    }

    $a['Will'] = 3.5;

    $c = array_keys($a);
    echo "<pre>";
    print_r($c);
    echo "</pre>";

    for ($i=0; $i < count($c) ; $i++) { 
        # code...
        $j = $c[$i];
        echo $a[$j];
        echo '<br>';
    }

?>