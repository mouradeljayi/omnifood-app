<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">

    <title>Omnifood Restaurant - Connexion</title>
  </head>
  <body>

    <style media="screen">
      * {
        font-family: 'Montserrat', sans-serif;
      }
    </style>

    <div class="container py-3">
      <div class="text-center">
        <a href="/"><img  src="{{ asset('images/omnifoodLogo.png') }}" width="150px" alt=""></a>
      </div>
      <h1 class="text-center py-3">CONNEXION</h1>
      <div class="row justify-content-center">
        <div class="col-md-6 p-3">
          <div class="card">
            <div class="card-body">
              <form method="POST" action="login">
                @csrf
                <div class="mb-3">
                  <label for="" class="form-label">Adresse E-mail</label>
                  <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Adresse E-mail" value="{{ old('email') }}">

                  @error('email')
                     <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                     </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="" class="form-label">Mot de passe</label>
                  <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe">

                  @error('password')
                     <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                     </span>
                  @enderror
                </div>
                <button type="submit" class="btn btn-success">Se Connectez</button>
                <a href="/" class="btn btn-outline-secondary">Page d'accueil</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
