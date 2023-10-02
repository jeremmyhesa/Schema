
<link rel="stylesheet" href="/css/home.css">
<div class="left">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
          <a class="navbar-brand" href="/">Schema</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
              <li class="nav-item">
                <a class="nav-link {{($title === 'Home') ? 'active' : ''}}" aria-current="page" href="/">Home</a>
              </li>
              
            </ul>
            

            <ul class="navbar-nav ms-auto">
                @auth
                <li class="nav-item">
                  <a class="nav-link {{($active === 'Home') ? 'active' : ''}}" aria-current="page" href="#">Tournaments</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link {{ ($active === "Categories") ? 'active' : ''}}" href="/categories">Categories</a>
                </li>
                <form action="/logout" method="post">
                  @csrf
                  <button type="submit" class="btn btn-danger">Logout</button>
              </form>
                  @else
              <li class="nav-item">
                <a class="nav-link {{($active === 'Login') ? 'active' : ''}}" href="#">Sign in</a>
                @endauth
              </li>
              
            </ul>
            
          </div>
        </div>
    </div>
      </nav>