<?php

use Goutte\Client;
use App\Services\Data;
use App\Models\Product;
use App\Services\Report;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\UriResolver;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/prva', function () {

    // Konekcija vraća Client objekat
    $client = new Client(HttpClient::create(['timeout' => 60]));

    // $crawler promenjiva čuva ceo html response 
    $crawler = $client->request('GET', 'https://gigatron.rs/bela-tehnika/frizideri');

    // Filter metoda selektuje linkove u okviru product boxa i uzima vrednost html atributa za kasnije pristupanje pojedinacnom proizvodu
    $crawler->filter('.product-box a')->each(function ($node) {
        
        // Samo kraj rute bez https://gigatron.rs
        $uri = $node->attr('href');
        // UriResolver na osnovu početne adrese razrešava konačnu URI rutu
        $resolved = UriResolver::resolve($uri, 'https://gigatron.rs/bela-tehnika/frizideri'); // http://localhost/foo
        // Ispisuje linkove ka proizvodima
        echo '<a href="' . $resolved . '">' . $uri . '</a><hr>';
    });   
});

Route::get('/', function() {

    // Prvi red
    $i = 1;

    while (true) {               

        $url = 'https://search.gigatron.rs/v1/catalog/get/bela-tehnika/frizideri?strana=' . $i;


        
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

});
