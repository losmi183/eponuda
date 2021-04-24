<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Eponuda</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item"><a class="nav-link" href="/">Početna</a></li>
            <li class="nav-item"><a class="nav-link" href="/about">Frizideru</a></li>
            <li class="nav-item"><a class="nav-link" href="/contact">Sporeti</a></li>
          </ul>      
        </div>
      </nav>    

      <div class="container mt-5">
          <div class="row">
              <div class="col-12 com-md-6">
                  
                  <h1>Gigatron</h1>
                  <h3>Bela tehnika</h3>
                  <form class="row" action="/bela-tehnika" method="POST">
                        
                    @csrf

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Tip proizvoda</label>
                            <select id="type" name="type" class="form-control">
                                <option value="">---odaberite tip---</option>
                                @foreach ($types as $type)
                                    <option value="{{ $type->slug }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Kategorija</label>
                            <select id="category" name="category" class="form-control"></select>
                        </div>
                    </div>


                    <div class="col-12">
                        <button class="btn btn-primary">Povuci u bazu</button>
                    </div>
            
            
                  </form>
              </div>
          </div>
      </div>



      
<script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script>

$('#type').change(function() {

  function setCategories(categories)
  {
        $('#category').empty();

      for(i = 0; i < categories.length; i++) {
          $('#category').append('<option value="' + categories[i].slug + '">' + categories[i].name + '</option>');
      }
  }


  var type = $(this).val();

  $.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url: "/categories", 
        type: 'POST',
        data: {
            "type" : type,
            "_token": "{{ csrf_token() }}",
        },
        success: function(result) {
            setCategories(result);
        }
    });

  

});

</script>

</body>
</html>