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
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container">
      <a class="navbar-brand text-white" href="home">Schema</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="nav">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ml-auto">
          <a class="nav-item nav-link active text-white" aria-current="page" href="/">Home</a>
          <a class="nav-item nav-link text-white" href="about">About</a>
          <a class="nav-item nav-link text-white" href="auth/login">Sign In</a>
          <a class="nav-item btn btn-primary tombol text-white" href="auth/register">Sign Up</a>
        </div>
      </div>
    </div>
    </div>
  </nav>
  {{-- akhir navbar --}}
<div class="container">
<h1>Halaman About</h1>
<h3>{{$users[0]->name}}</h3>
<p>{{$users[0]->email}}</p>
<img src="/img/user.png" alt={{$users[0]->name}} width="200" class="img-thumbnail rounded-circle">
</div>

