<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
      /* Limit the size of the navbar brand image */
      .navbar-brand img {
          height: 70px;
          max-width: 100%;
          object-fit: contain;
      }

      body {
          background-color: #F2F5F6;
          margin: 0;
          padding: 0;
      }

      .btn-custom {
          background-color: #136370;
          color: #ffffff;
          border: 1px solid #136370;
      }
      .btn-custom:hover {
          background-color: #0f4f59;
          border-color: #0f4f59;
      }
      /* Outline Button */
        .btn-outline-custom {
            background-color: transparent;
            color: #136370;
            border: 1px solid #136370;
        }
        .btn-outline-custom:hover {
            background-color: #136370;
            color: #ffffff;
            border-color: #136370;
        }

      .nav-link.active {
          font-weight: 600;
      }

      th {
        padding: 10px;
      }
      td {
        padding: 10px;
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
                        <a class="nav-link " href="{{ route('emission.index') }}">
                            <i class="fa-solid fa-shoe-prints"></i>
                            Emission Category
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="/content-list">
                            <i class="fa-solid fa-image"></i>
                            Manage Education Content
                        </a>
                    </li>
                </ul>

                    <!-- Profile Avatar and Logout Icon -->
                    <div class="d-flex align-items-center">
                        <!-- Profile Avatar -->
                        <a href="{{ route('profile') }}" class="nav-link active me-3 text-decoration-none">
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
        
        <div class="row container-fluid justify-content-center ms-1">
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="col-6 mb-4">
                    <div class="mb-3">
                        <img src="assets/avatar.png" alt="Profile Avatar" class="rounded-circle me-5" style="height: 100px; width: 100px; object-fit: cover;">
                        <button type="" class="btn btn-outline-custom">Upload New Picture</button>
                        <button type="" class="btn btn-custom">Delete</button>
                    </div>
                <form action="{{ route('profile.update') }}" method="POST" class="mt-5 w-100">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" placeholder="Name" value="{{ Auth::user()->name }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Email" value="{{ Auth::user()->email }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="old_password" class="form-label">Old Password</label>
                        <input type="password" id="old_password" name="old_password" class="form-control" placeholder="Enter Old Password">
                        @error('old_password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">New Password</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="New Password">
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm New Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="Confirm New Password">
                    </div>
                    <button type="submit" class="btn btn-custom">Save Profile</button>
                </form>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
