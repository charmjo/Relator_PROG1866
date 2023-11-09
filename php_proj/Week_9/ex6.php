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

    // usecase
    // we run this for associative arrays with reference to the value
    // we run this when we update an array
    for ($i=0; $i < count($c) ; $i++) { 
        # code...
        $j = $c[$i]; // assigns the keys
        echo $a[$j]; // gets the value using the keys
        echo '<br>';
    }

    foreach ($a as $value) {
        echo $value;
        echo '<br>';
    }
?>