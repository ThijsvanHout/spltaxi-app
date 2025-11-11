<!DOCTYPE html>
<html lang="en">
<head>
  <title>Over SPL -Schiphol-Taxi</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}">

  
  
</head>
<body>
    
    <!-- sidebar menu -->
<ul class="navbar-side" id="navbarSide">
<li class="navbar-side-item"><a href="https://www.spl.taxi/over-amstelveen-schiphol-taxi/">OVER ONS</a></li>
<li class="navbar-side-item"><a href="https://reserve.spl.taxi/">RESERVEREN</a></li>
<li class="navbar-side-item">
       <a href="javascript:void(0)" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LOCATIES<i class="fa fa-angle-down float-right"></i></a>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/aalsmeer/">Aalsmeer</a></li>
            <li><a class="navbar-side-item" href="https://www.spl.taxi/schiphol-taxi/amstelveen/">Amstelveen</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/abcoude/">Abcoude</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/amsterdam/">Amsterdam</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/diemen/">Diemen</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/duivendrecht/">Duivendrecht</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/haarlem/">Haarlem</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/ouderkerk/">Ouderkerk ad Amstel</a></li>
            <li><a class="navbar-side-item" href="https://spl.taxi/schiphol-taxi/uithoorn/">Uithoorn</a></li>
            <li><a class="navbar-side-item" href="https://www.spl.taxi/vinkeveen/">Vinkeveen</a></li>
        </ul>
    </li>
</ul>

<div class="overlay"></div>
 <!-- sidebar menu -->
 <div class="main-bg {{ Request::is(['about', 'reserve', '/']) ? ' overons-bg' : '' }}">  
<header class="headertop">
    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-lg-2 col-2">
                <div class="left-menu">
                    <button class="navbar-toggler pull-xs-right" id="navbarSideButton" type="button">
                        <i class="fa-sharp fa-solid fa-bars"></i>
                    </button>
                </div>
            </div>
            <div class="col-lg-7 col-8 text-center">
                <div class="center-logo">
                    <a href="https://www.spl.taxi/"><img src="{{ asset('frontend/images/logo.png') }}" alt="logo"></a>
                </div>
            </div>
            <div class="col-lg-3 col-2">
                <div class="right-menu res-none">
                    <ul>
                        <li><a href="https://www.spl.taxi/over-amstelveen-schiphol-taxi/">OVER ONS</a></li>
                        <li><a href="https://reserve.spl.taxi/">RESERVEREN</a></li>
                        <li class="dropdown"><a href="javascript:void(0)">LOCATIES<i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-item">
                                <li><a href="https://spl.taxi/schiphol-taxi/aalsmeer/">Aalsmeer</a></li>
                                <li><a href="https://www.spl.taxi/schiphol-taxi/amstelveen/">Amstelveen</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/abcoude/">Abcoude</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/amsterdam/">Amsterdam</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/diemen/">Diemen</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/duivendrecht/">Duivendrecht</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/haarlem/">Haarlem</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/ouderkerk/">Ouderkerk ad Amstel</a></li>
                                <li><a href="https://spl.taxi/schiphol-taxi/uithoorn/">Uithoorn</a></li>
                                <li><a href="https://www.spl.taxi/vinkeveen/">Vinkeveen</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>