<?php

namespace App\Services;

use App\Models\Product;

class Report {

    public static function fire($i, $url, $result_array)
    {
        // Prikazuje broj stranicu koju zahteva i response 
        echo 'Rbr stranice: ' . $i . '<br>';      
        echo 'Url: ' . $url . '<br>';  
        echo 'Odgovor: ';    
        dump($result_array);
    }

}


