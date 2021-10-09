<!DOCTYPE html>
<html lang="en" class="h-100">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
  <script src="{{ asset('css/bootstrap.min.js') }}"></script>
  <title>Bazar | @yield('title')</title>
  <style>
    .sb{
      position: absolute;
      margin-left: auto;
      margin-right: auto;
      left: 25vw;
      right: 23vw;
      text-align: center;
      max-width: 350px;
    }
  </style>
</head>
<body class="d-flex flex-column" style="min-height: 100vh;">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggle" aria-controls="navbarToggle" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="/">Bazar</a>
    <div class="collapse navbar-collapse" id="navbarToggle">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link {{ request()->is('home') || request()->is('/') ? 'active' : ''}}" aria-current="page" href="/home">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('stats') ? 'active' : ''}}" href="/stats">Stats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ request()->is('addlisting') ? 'active' : ''}}" href="/addlisting">Create Listing</a>
        </li>
      </ul>
      @guest
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="btn btn-light me-1" href="/login">Login</a>
          </li>
          <li class="nav-item">
            <a class="btn btn-success me-1" href="{{route('register')}}">Register</a>
          </li>
        </ul>
      @else
        <ul class="nav justify-content-end">
          <li class="nav-item">
            <a class="btn btn-success me-1 d-flex align-items-center gap-1" href="/profile">{!! Auth::user()->admin ? '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-star-fill" viewBox="0 0 16 16">
              <path d="M3.612 15.443c-.386.198-.824-.149-.746-.592l.83-4.73L.173 6.765c-.329-.314-.158-.888.283-.95l4.898-.696L7.538.792c.197-.39.73-.39.927 0l2.184 4.327 4.898.696c.441.062.612.636.282.95l-3.522 3.356.83 4.73c.078.443-.36.79-.746.592L8 13.187l-4.389 2.256z"/>
            </svg>' : "" !!}{{ Auth::user()->name }}</a>
          </li>
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <input class="btn btn-light" type="submit" value="logout">
          </form>
      @endguest
    </div>

    <form class="d-flex sb" style="">
      <input class="form-control me-1" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
  </div>
</nav>
<div class="container-fluid flex-grow-1 bg-secondary">

  @yield('content')
</div>
</body>
</html>