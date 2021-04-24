<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Eponuda</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="/">Eponuda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/">Početna</a></li>

            <?php
                $tvAudioVideo = App\Models\Category::where('type_slug', 'tv-audio-video')->get();
                $belaTehnika = App\Models\Category::where('type_slug', 'bela-tehnika')->get();

                // dd($tvAudioVideo);
            ?>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Bela tehnika</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($belaTehnika as $item)
                        <a class="dropdown-item" href="/bela-tehnika/{{ $item->slug }}">{{$item->name}}</a>
                    @endforeach
                </div>
              </li>

            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Televizori</a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach ($tvAudioVideo as $item)
                        <a class="dropdown-item" href="/tv-audio-video/{{ $item->slug }}">{{$item->name}}</a>
                    @endforeach
                </div>
              </li>

          </ul>      
        </div>
    </nav>    

      <div class="container-fluid mt-5">
          <div class="row">
              <div class="col-12">  <h1>{{ $slug }}</h1></div>

              <div class="col-12">
                  {{ $products->links('pagination::bootstrap-4') }}
              </div>

              {{-- @if (count($products) < 1) --}}
                @foreach ($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 border p-3">
                        <h5>Naziv: {{ $product->name }}</h5>
                        <p>Ean: {{ $product->ean }}</p>
                        <p>Brend: {{ $product->brand }}</p>
                        <p>Cena: {{ $product->price }}</p>
                        <img src="{{ $product->small_image }}" alt="">
                        <hr>
                        <a href="{{ $product->homepage . $product->url }}">KUPI</a>
                    </div>
                @endforeach
              {{-- @else
                    <p>Trenutno nema {{ $slug }} u bazu. Učitajte ovu kategoriju na pocetnoj</p>
              @endif --}}

          </div>
      </div>



      
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>



</body>
</html>