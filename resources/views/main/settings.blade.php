<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>Schema | Settings</title>

    <!-- Favicon -->
    <!-- Responsive CSS -->
    <link href="/css/gaya.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/tour.css">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">


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
        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Nama User
          </button>
          <ul class="dropdown-menu dropdown-menu-dark">
            <li><a class="dropdown-item active" href="#">LogOut</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Separated link</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  </div>
</nav>
{{-- akhir navbar --}}

 {{-- Jumbotron --}}
 <div class="p-5 mb-4 bg-light rounded-3 jumbotron">
  <div class="container py-5">
    <h1 class="display-5 fw-bold">Nama Tournament</h1>

  <div class="col info">
    <div class="row">
      <div class="col-lg user">
    <h5><img src="/img/user.png" alt="user"> 16 </h5>
  </div>
  <div class="col-lg">
    <h5><img src="/img/trophy.png" alt="trophy"> Single Elimination </h5>
  </div>
  <div class="col-lg">
    <h5><img src="/img/calendar.png" alt="calendar"> Waktu Turnamen</h5>
  </div>
  <div class="col-lg joystick">
    <h5><img src="/img/joystick.png" alt="joystick"> Mobile Legends</h5>
  </div>
  </div>
  </div>
  </div>
</div>
{{-- Akhir Jumbotron --}}

<nav class="navbar navbar-expand-lg bg-dark navbar2">
  <div class="container-fluid navdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active link2" aria-current="page" href="/index/tournament/bracket">Bracket</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link2" href="/index/tournament/add">Participants</a>
        </li>
        <li class="nav-item">
          <a class="nav-link link2" href="/index/tournament/settings">Settings</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
