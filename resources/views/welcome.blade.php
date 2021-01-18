<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <title>Omnifood Restaurant</title>
  </head>
  <body style="background-color: #f5f5f5;">

    <style media="screen">
    * {
      font-family: 'Montserrat', sans-serif;
    }

    main {
      margin-top: 70px;
    }
    p {
      margin-top: 100px;
      font-size: 50px;
    }
    img {
      margin-top: 40px;
    }
    section {
      margin-top: 100px;
      border-top: 2px solid grey;
      padding: 10px;
    }
    </style>

    <main>
      <div class="container">
        <div class="row">
          <div class="col-md-8">
            <p>OMNIFOOD RESTAURANT MANAGEMENT SYSTEM</p>
            <a href="/login" class="btn btn-success btn-lg">CONNEXION</a>
          </div>
          <div class="col-md-4">
            <img src="{{ asset('images/omnifoodLogo.png') }}" alt="" >
          </div>
        </div>
      </div>
    </main>

    <section class="text-center">
      <span>Copyright &copy;	2020 Developed by Mourad Eljayi</span>
    </section>

  </body>
</html>
