<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- My Css --}}
    <link rel="stylesheet" href="css/index.css">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Schema | Your Tournaments</title>
  </head>
  <body class= "bg-dark">
    {{-- navbar --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
      <a class="navbar-brand" href="index">Schema</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="nav">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link active" aria-current="page" href="#">Home</a>
          <a class="nav-item nav-link" href="#">Features</a>
        </div>
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nama User
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item active" href="#">Edit Profil</a></li>
            <li><a class="dropdown-item" href="#">LogOut</a></li>
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
      <h1 class="display-5 fw-bold">Your Tournaments</h1>
      <a href="index/new" class="btn btn-primary tombol-2">Create a Tournament</a>

    </div>
  </div>
  {{-- Akhir Jumbotron --}}

  {{-- Container --}}
  <div class="container">
  <div class="row justify-content-center bg-dark">
    <div class="col-10 info bg-dark">
      <div class="row">
        <div class="col-5">
          <form class="d-flex search">
            <input class="form-control me-2" type="search" placeholder="Search your tournaments" aria-label="Search">
            <button class="btn btn-outline-success" type="submit">Search</button>
          </form>
          </div>
          <div class="card">
          <a class="card-tourney" href="index/tournament">
            <div class="card-body">
              <h5 class="card-title">Piala Warkop</h5>
              <p class="card-text">Single Elimination</p>
            </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  {{-- Akhir container --}}

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    
  </body>
</html>