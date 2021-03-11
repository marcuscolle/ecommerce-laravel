
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.80.0">
    <title>Laravel Ecomm / Admin Dashboard</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/dashboard/">

    <link href="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css')}}" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="{{ asset('https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js')}}" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    

    <!-- Bootstrap core CSS -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="{{ asset('/docs/5.0/assets/img/favicons/apple-touch-icon.png')}}" sizes="180x180">
    <link rel="icon" href="{{ asset('/docs/5.0/assets/img/favicons/favicon-32x32.png')}}" sizes="32x32" type="image/png">
    <link rel="icon" href="{{ asset('/docs/5.0/assets/img/favicons/favicon-16x16.png')}}" sizes="16x16" type="image/png">
    <link rel="manifest" href="{{ asset('/docs/5.0/assets/img/favicons/manifest.json')}}">
    <link rel="mask-icon" href="{{ asset('/docs/5.0/assets/img/favicons/safari-pinned-tab.svg')}}" color="#7952b3">
    <link rel="icon" href="{{ asset('/docs/5.0/assets/img/favicons/favicon.ico')}}">
    <meta name="theme-color" content="#7952b3">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="{{ asset('dashboard.css')}}" rel="stylesheet">
  </head>
  
<body>
    
<header class="navbar navbar-dark sticky-top flex-md-nowrap p-0 shadow" style="background-color: #f8f8f8b8">

  <button class="navbar-toggler position-absolute d-md-none collapsed" style="background-color: #6e6e6e" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div>
    <i class="far fa-user-check" style="font-size: 20px" ></i>  {!! Auth::user()->name !!}
  </div>

</header>

<div class="container-fluid">
  <div class="row">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse" style="background-color: #f8f8f8b8">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" style="color:black;" aria-current="page" href="{{ route('products') }}">
                  <i class="fas fa-home fa-1x"></i>
                  Website
                </a>
              </li>  
          <li class="nav-item">
            <a class="nav-link active" style="color:black;" aria-current="page" href="{{ route('dashboard') }}">
              
              <i class="fas fa-tachometer-alt fa-1x"></i> Dashboard 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="/admin/createProductForm">
              
              <i class="fas fa-plus fa-1x"></i> Create New Poduct
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="{{ route('orders') }}">
              <i class="fas fa-file-invoice fa-1x"></i>
              Orders
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="{{ route('adminDisplayProducts') }}">
              <i class="fas fa-list-ol fa-1x"></i>
              Products
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="{{ route('customers') }}">
              <i class="fas fa-user-tie 1x"></i>
              Customers
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="{{ route('earnings') }}">
              <i class="fas fa-hand-holding-usd fa-1x"></i>
              Earnings
            </a>
          </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
          <span>Saved reports</span>
          <a class="link-secondary" style="color:black;" href="#" aria-label="Add a new report">
            <span data-feather="plus-circle"></span>
          </a>
        </h6>
        <ul class="nav flex-column mb-2">
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="#">
              <span data-feather="file-text"></span>
              Current month
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="#">
              <span data-feather="file-text"></span>
              Last quarter
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="#">
              <span data-feather="file-text"></span>
              Social engagement
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" style="color:black;" href="#">
              <span data-feather="file-text"></span>
              Year-end sale
            </a>
          </li>
        </ul>
      </div>
    </nav>

    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Laravel Ecomm Admin Panel</h1>
      </div>
   


    <script src="/docs/5.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="dashboard.js"></script>
  
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
  
</body>
</html>
