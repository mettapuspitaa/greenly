<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
      /* Normal navbar color */
      .navbar {
          background-color: #ffffff;
          transition: background-color 0.3s ease; /* Smooth transition for color change */
      }

      /* Navbar color when scrolling */
      .navbar.scrolled {
          background-color: #f8f9fa; /* Light gray, slightly different from the body */
      }

      /* Limit the size of the navbar brand image */
      .navbar-brand img {
          height: 70px;
          max-width: 100%;
          object-fit: contain;
      }

      body {
          background-color: #F2F5F6; /* Light gray background color */
          margin: 0;
          padding: 0;
          overflow-x: hidden;
      }

      .card {
          padding: 15px;
          border: 1px solid #e0e0e0;
          border-radius: 8px;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .card h5 {
          font-weight: bold;
          margin-bottom: 10px;
      }

      .card img {
          height: 150px;
          width: 100%;
          object-fit: cover;
          border-radius: 8px;
          margin-top: 10px;
      }
    </style>
  </head>
  <body>
    <!-- Navbar with sticky-top class added -->
    <nav class="navbar navbar-expand-lg sticky-top">
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
                        <a class="nav-link " href="/dashboard">
                            <i class="fa-solid fa-house"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link active " href="/carboncalc">
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
                        <a class="nav-link" href="/educontent">
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

    <div class="container content-container mt-4">
        <div class="row">
            @forelse ($contents as $content)
                <div class="col-md-6 col-sm-12 mb-4">
                    <div class="card">
                        <h5>{{ $content->name }}</h5>
                        <p>{{ Str::limit($content->description, 100) }}</p>
                        <img src="{{ asset('storage/' . $content->path) }}" alt="Content Image">
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center">No educational content available. Check back later!</p>
                </div>
            @endforelse
        </div>
    </div>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <!-- JavaScript for detecting scroll -->
    <script>
        window.onscroll = function() {scrollFunction()};

        function scrollFunction() {
            var navbar = document.querySelector('.navbar');
            if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
                navbar.classList.add("scrolled"); // Add 'scrolled' class when scrolled
            } else {
                navbar.classList.remove("scrolled"); // Remove 'scrolled' class when at top
            }
        }
    </script>
  </body>
</html>
