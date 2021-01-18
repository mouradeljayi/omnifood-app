<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Omnifood Restaurant</title>
  </head>
  <body style="background-color: #f5f5f5;">

    <style media="screen">
    * {
      font-family: 'Montserrat', sans-serif;
    }

    .top{
      margin-top: 90px;
    }
    a {
      text-decoration: none;
    }
    </style>

    <main>
      <div class="container text-center">
        <h1 class="mt-5">BIENVENUE !</h1>
        <h3>Veuillez choisir une tache</h3>
        <div class="row top">
          <div class="col-md-4 mt-3">
            <a href="{{ route('categories.index') }}">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-cog fa-5x text-danger mb-3"></i>
                  <h4 class="text-danger">RESSOURCES</h4>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 mt-3">
            <a href="{{ route('payements.index') }}">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-credit-card fa-5x text-primary mb-3"></i>
                  <h4 class="text-primary">VENTES</h4>
                </div>
              </div>
            </a>
          </div>

          <div class="col-md-4 mt-3">
            <a href="{{ route('reports.index') }}">
              <div class="card p-4">
                <div class="card-body">
                  <i class="fa fa-clipboard-list fa-5x text-success mb-3"></i>
                  <h4 class="text-success">RAPPORTS</h4>
                </div>
              </div>
            </a>
          </div>

        </div>
      </div>
    </main>

  </body>
</html>
