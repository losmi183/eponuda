<?php

use Goutte\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FetchController;
use App\Http\Controllers\FrontController;
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

Route::post('/bela-tehnika', [FetchController::class, 'download']);

Route::get('/', [FrontController::class, 'index']);

Route::get('/bela-tehnika/{slug}', [FrontController::class, 'products']);
Route::get('/tv-audio-video/{slug}', [FrontController::class, 'products']);

Route::post('/categories', [FrontController::class, 'categories']);


Route::get('/scrape', function () {

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
