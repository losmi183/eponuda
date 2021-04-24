<?php

use Goutte\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\DomCrawler\UriResolver;
use App\Models\Product;



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
        

        // $link = 'https://search.gigatron.rs/v1/catalog/get/bela-tehnika/frizideri?strana=15';
        $link = 'https://search.gigatron.rs/v1/catalog/get/bela-tehnika/frizideri?strana=' . $i;

        // dd($link);

        $response = Http::get($link)->json();

        dump($response['hits']['hits']);

        
        if (empty($response['hits']['hits'])) {
            echo '$i = ' . $i . '   nema vise kraj';
            break;
        }
        
        echo '$i = ' . $i . '<hr>';

        $i++;

        
        // $result_array = ($response['hits']['hits']);

        // // Proverava da li i dalje postoji nešto u result array. Ako vrati 0 izlayi se iz petlje
        // if($result_array == '') {
        //     echo '$i = ' . $i . '     ,,,   ';
        //     echo 'NISTA NIJE VRATIO';
        //     dd($result_array);
        // }
        // // dd($result_array);
        // // echo $result['_source']['search_result_data']['ean'] . '<hr>';
    
        // foreach($result_array as $result)
        // {        
        //     // echo $result['_source']['search_result_data']['ean'] . '<hr>';
        //     Product::create([
        //         'ean' => $result['_source']['search_result_data']['ean'] ?? '',
        //         'name' => $result['_source']['search_result_data']['name'] ?? '',
        //         'brand' => $result['_source']['search_result_data']['brand'] ?? '',
        //         'price' => $result['_source']['search_result_data']['price'] ?? '',
        //         'price_retail' => $result['_source']['search_result_data']['price_retail'] ?? '',
    
        //         'small_image' => $result['_source']['search_result_data']['small_image'] ?? '',
        //         'image' => $result['_source']['search_result_data']['image'] ?? '',
        //         'big_image' => $result['_source']['search_result_data']['big_image'] ?? '',
                
        //         'group_slug' => $result['_source']['search_result_data']['group_slug'] ?? '',
        //         // 'ean' => $result['_source']['search_result_data']['homepage'],
        //         'url' => $result['_source']['search_result_data']['url'] ?? '',
        //     ]);
            
            // dump($result['_source']['search_result_data']);
            // dump($result['_source']['search_result_data']['ean']);
        // }
    }

});
