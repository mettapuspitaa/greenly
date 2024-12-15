<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Greenly</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            margin: 0; /* Remove default margins */
            padding: 0; /* Remove default paddings */
            height: 100vh; /* Full viewport height */
            overflow: hidden; /* Prevent scrolling */
        }
        .section2 {
            background-image: url("{{ asset('assets/co2.png') }}");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 90%;
        }
        .section1 {
            margin-right: 2rem; /* Adjust this value for the gap */
        }
        a {
            color: orange;
            font-weight: bold;
            text-decoration: none; /* Remove underline */
        }
        /* Custom button color */
        .btn-custom {
            background-color: #136370; /* Set custom background color */
            color: #ffffff; /* Set text color */
            border: 1px solid #136370; /* Match border color to the background */
        }
        .btn-custom:hover {
            background-color: #0f4f59; /* Darker shade for hover effect */
            border-color: #0f4f59; /* Adjust border color on hover */
        }
    </style>
  </head>
  <body>
    <div class="row m-2 d-flex justify-content-center align-items-center h-100">
            <div class="section1 col-4 d-flex flex-column justify-content-center align-items-center">
                <div class="text-center">
                    <h1>Hello There!</h1>
                </div>

                <!-- Display Alerts -->
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show mt-3 w-100" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show mt-3 w-100" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show mt-3 w-100" role="alert">
                        <ul class="mb-0">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                <!-- Registration Form -->
                <form action="{{ route('register') }}" method="POST" class="mt-5 w-100">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" id="passwordInput" class="form-control" placeholder="Password" name="password">
                        <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                            <i class="bi bi-eye"></i>
                        </button>
                        @error('password')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mt-5">Sign Up</button>
                    <div class="mt-3 text-center">
                        Already have an account? <a href="/login">Sign In</a>
                    </div>
                </form>
            </div>
        <div class="section2 col-7 rounded">
            <!-- Background image section -->
        </div>
    </div>
    <script>
        // JavaScript to handle password visibility toggle
        const passwordInput = document.getElementById("passwordInput");
        const togglePassword = document.getElementById("togglePassword");

        togglePassword.addEventListener("click", function () {
            // Toggle the input type between password and text
            const type = passwordInput.type === "password" ? "text" : "password";
            passwordInput.type = type;

            // Update the button icon
            this.innerHTML = type === "password" ? '<i class="bi bi-eye"></i>' : '<i class="bi bi-eye-slash"></i>';
        });
    </script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <!-- Bootstrap Icons (for eye icon) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  </body>
</html>
