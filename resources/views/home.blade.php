<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- My Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Viga&display=swap" rel="stylesheet">

    {{-- My CSS --}}
    <link rel="stylesheet" href="css/home.css">
    <title>Schema | Home</title>
  </head>
  <body>
  {{-- navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light">
    <div class="container">
      <a class="navbar-brand" href="home">Schema</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="nav">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto">
          <a class="nav-item nav-link active" aria-current="page" href="/">Home</a>
          <ul class="navbar-nav ms-auto">
            @auth
            <a class="nav-item nav-link active" aria-current="page" href="dashboard">Dashboard</a>
            <a class="nav-item nav-link active" aria-current="page" href="tournaments">Tournaments</a>
            <form action="/logout" method="post">
              @csrf
              <button type="submit" class="nav-link bg-dark border-0"><span data-feather="log-out" class="align-text-bottom"></span>Logout</button>
          </form>
            @else
          <li class="nav-item">
            <a class="nav-link {{($title === 'Login') ? 'active' : ''}}" href="auth/login">Sign in</a>
            @endauth
          </li>
        </ul>
          
        </div>
      </div>
    </div>
    </div>
  </nav>
  {{-- akhir navbar --}}

  {{-- Jumbotron --}}
  <div class="p-5 mb-4 bg-light rounded-3 jumbotron">
    <div class="container py-5">
      <h1 class="display-5 fw-bold">Make Your Own <span>Tournaments</span> and <span><br>Brackets
      </span> With Us</h1>
      <a href="auth/register" class="btn btn-primary tombol">Create Tournament</a>
      <a href="#" class="btn btn-secondary tombol"> Try It</a>
    </div>
  </div>
  {{-- Akhir Jumbotron --}}

  {{-- Container --}}
<div class="container">

  {{-- Info Panel --}}
  <div class="row justify-content-center">
    <div class="col-10 info-panel">
      <div class="row">
        <div class="col-lg">
          <img src="img/employee.png" alt="Employee" class="float-start">
          <h4>24 Hours</h4>
          <p>EveryTime</p>
        </div>
        <div class="col-lg">
          <img src="img/hires.png" alt="High Res" class="float-start">
          <h4>High-Res</h4>
          <p>High resolution bracket and image</p>
        </div>
        <div class="col-lg">
          <img src="img/security.png" alt="Security" class="float-start">
          <h4>Security</h4>
          <p>Keep your safety with us</p>
        </div>
      </div>

    </div>
  </div>
  {{-- Akhir Info Panel --}}

  {{-- WorkingSpace --}}
  <div class="row workingspace">
    <div class="col-lg-6">
      <img src="img/field.jpg" alt="Field" class="img-fluid">
    </div>
    <div class="col-lg-5">
      <h3>Manage Your <span>Tournaments</span> and <span>Brackets</span></h3>
      <p>Enjoy Your Game, We Handle The Rest</p>
      <a class="btn btn-primary tombol" href="#">Tournaments</a>
    </div>
  </div>
  {{-- Akhir WorkingSpace --}}

  {{-- Quotes --}}
  <section class="quotes">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <h5>" You have to fight to reach your dream. You have to sacrifice and work hard for it "</h5>
      </div>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-6 justify-content-center d-flex">
        <figure class="figure">
          <img src="img/curry.jpg" class="figure-img img-fluid rounded-circle" alt="Quote 1">
        </figure>
        <figure class="figure">
          <img src="img/messi.jpg" class="figure-img img-fluid rounded-circle utama" alt="Quote 2">
          <figcaption class="figure-caption">
            <h5>Lionel Messi</h5>
            <p>Footballer</p>
          </figcaption>
        </figure>
        <figure class="figure">
          <img src="img/kevin.jpg" class="figure-img img-fluid rounded-circle" alt="Quote 3">
        </figure>
      </div>
    </div>
  </section>
  
  {{-- Akhir Quotes --}}

  {{-- Footer --}}
  <div class="row footer">
    <div class="col text-center">
      <p>2022 All Rights Reserved by Schema</p>
    </div>
  </div>
  {{-- Akhir Footer --}}



</div>
  {{-- Akhir Container --}}









    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" 
integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" 
crossorigin="anonymous"></script>

<script src="/js/dashboard.js"></script>

  </body>
</html>