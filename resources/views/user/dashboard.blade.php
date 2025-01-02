<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
      /* Limit the size of the navbar brand image */
      .navbar-brand img {
          height: 70px; /* Set the height of the image */
          max-width: 100%; /* Ensure the image doesn't exceed the width of its container */
          object-fit: contain; /* Ensure the image scales correctly without stretching */
      }
      
      /* Set the overall background color */
    body {
        background-color: #F2F5F6; /* Light gray background color */
        margin: 0; /* Remove any default margin */
        padding: 0; /* Remove any default padding */
        overflow-x: hidden; /* Prevent horizontal scrolling */
    }
    </style>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <!-- Navbar Brand -->
                <a class="navbar-brand me-5" href="#">
                    <img src="assets/navlogo.png" alt="Logo">
                </a>

                <!-- Toggle Button for Mobile View -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Navbar Links -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item me-3">
                            <a class="nav-link " href="#">
                                <i class="fa-solid fa-house"></i>
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link " href="/carboncalc">
                                <i class="fa-solid fa-shoe-prints"></i>
                                Carbon Calculate
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="/history">
                                <i class="fa-solid fa-file"></i>
                                History
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="/leaderboard">
                                <i class="fa-solid fa-ranking-star"></i>
                                Leaderboard
                            </a>
                        </li>
                        <li class="nav-item me-3">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-image"></i>
                                Education Content
                            </a>
                        </li>
                    </ul>

                    <!-- Profile Avatar and Logout Icon -->
                    <div class="d-flex align-items-center">
                        <!-- Profile Avatar -->
                        <a href="{{ route('userprofile') }}" class="nav-link me-3 text-decoration-none">
                            {{Auth::user()->name;}}
                            <img src="assets/avatar.png" alt="Profile Avatar" class="rounded-circle" style="height: 40px; width: 40px; object-fit: cover;">
                        </a>
                        <!-- Logout Icon -->
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-link text-dark text-decoration-none p-0">
                                <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </nav>
        <div class="row">
            <div class="col">
                <div class="row ms-1 p-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-start p-3">
                                    <img class="col-2" src="assets/bus.png" alt="Logo">
                                    <h4 class="card-title p-1 col">Transportation</h4>
                                </div>
                                <div class="row d-flex justify-content-between align-items-center mt-5 p-3">
                                    <div class="col-8 d-flex">
                                        <h1 class="form-label mb-0" name="emission_km">
                                            {{ $latestSkor->emission_km ?? '0' }}
                                        </h1>
                                        <p class="mt-3 p-1">kg CO₂e/kg</p>
                                    </div>
                                    <img class="col-2" src="assets/graph1.png" alt="Graph">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-start p-3">
                                    <img class="col-2" src="assets/diet.png" alt="Logo">
                                    <h4 class="card-title p-1 col">Food</h4>
                                </div>
                                <div class="row d-flex justify-content-between align-items-center mt-5 p-3">
                                    <div class="col-8 d-flex">
                                        <h1 class="form-label mb-0" name="emission_food">
                                            {{ $latestSkor->emission_food ?? '0' }}
                                        </h1>
                                        <p class="mt-3 p-1">kg CO₂e/kg</p>
                                    </div>
                                    <img class="col-2" src="assets/graph2.png" alt="Graph">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row ms-1 p-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-start p-3">
                                    <img class="col-2 " src="assets/bus.png" alt="Logo">
                                    <h4 class="card-title p-1 col">Energy</h4>
                                </div>
                                <div class="row d-flex justify-content-between align-items-center mt-5 p-3">
                                    <div class="col-8 d-flex">
                                        <h1 class="form-label mb-0" name="emission_kwh">
                                            {{ $latestSkor->emission_kwh ?? '0' }}
                                        </h1>
                                        <p class="mt-3 p-1">kg CO₂e/kg</p>
                                    </div>
                                    <img class="col-2" src="assets/graph3.png" alt="Logo">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="row d-flex justify-content-start p-3">
                                    <img class="col-2 " src="assets/bus.png" alt="Logo">
                                    <h4 class="card-title p-1 col">Emission</h4>
                                </div>
                                <div class="row d-flex justify-content-between align-items-center mt-5 p-3">
                                    <div class="col-8 d-flex">
                                        <h1 class="form-label mb-0" name="totalemission">
                                            {{ $latestSkor->emission_food + $latestSkor->emission_kwh + $latestSkor->emission_km ?? '0' }}
                                        </h1>
                                        <p class="mt-3 p-1">kg CO₂e/kg</p>
                                    </div>
                                    <img class="col-2" src="assets/graph4.png" alt="Logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ms-1 p-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
            <div class="col p-3 me-4">
                <div class="card">
                    <div class="card-body d-flex justify-content-center">
                        <h1 class="p-5">Leaderboard Today</h1>
                    </div> 
                </div> 
            </div> 
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html> 
