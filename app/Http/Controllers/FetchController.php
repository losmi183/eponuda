<?php

namespace App\Http\Controllers;

use App\Services\Data;
use App\Services\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class FetchController extends Controller
{
    public function belaTehnika(Request $request)
    {
            $request->validate([
                'type' => 'required',
                'category' => 'required'
            ]);

            $type = $request->type;
            $category = $request->category;

            dump('PREUZIMANJE PODATAKA, TIP: ' .$type. ' KATEGORIJA:' . $category);
            echo '++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++';

            // Prvi red
            $i = 1;

            while (true) {               

                $url = 'https://search.gigatron.rs/v1/catalog/get/' . $type . '/' . $category . '?strana=' . $i;

                        


                
                // Server salje get request gigatronu za zeljeni proizvod $i stranicu
                $response = Http::get($url)->json();
                // Rezultati od interesa se čuvaju u $result_array
                $result_array = ($response['hits']['hits']);

                // Metoda koja prikazuje report o svakoj iteraciji
                Report::fire($i, $url, $result_array);

                // Ako iteracija vrati prazan niz znaci da nema vise proizvoda i prekida se loop
                if (empty($response['hits']['hits'])) {
                    echo '$i = ' . $i . '   stranica ne sadrzi proizvode i prekida se izvrsavanje';
                    break;
                }
                
                // Pozivanje stati;ke metode koja kroz foreack loop čuva podatke u bazi
                Data::save($result_array);    

                $i++;
            }
        echo '<hr>';
        echo '<a class="btn btn-primary" href="/">Back</a>';
    }
}
