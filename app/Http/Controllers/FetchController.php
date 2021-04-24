<?php

namespace App\Http\Controllers;

use App\Models\Product;
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

            /**
             * Prvo se brišu stari podaci za selektovanu kategoriju
             */
            $res = Product::where('group_slug', $category)->delete();

            // dd($res);


            dump('PREUZIMANJE PODATAKA, TIP: ' .$type. ' KATEGORIJA:' . $category);
            echo '++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++<br>';

            // Prvi red
            $i = 1;
            $products_processed = 0;

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
                $products_processed += count($result_array);
            }
        dump('Preuzeto proizvoda: ' . $products_processed);
        echo '<hr>';
        echo '<a class="btn btn-primary" href="/">Back</a>';
    }
}
