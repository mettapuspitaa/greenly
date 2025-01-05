<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Emission Category</title>
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
                    <a href="{{ route('profile') }}" class="nav-link me-3 text-decoration-none">
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
    <div class="p-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Manage Emission Category</h2>
            <!-- Button to Open Modal -->
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addNewModal">
                Add New
            </button>
        </div>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row mt-5 p-2">
            <table>
                <thead style="background-color: #136370; color: white;">
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Emission</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($emissions as $emission)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $emission->name }}</td>
                            <td>{{ ucfirst($emission->type) }}</td>
                            <td>{{ $emission->emission }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('emission.edit', $emission->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('emission.destroy', $emission->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this emission?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <div class="col">
                <h5 class="modal-title" id="addNewModalLabel">Add Emission Category</h5>
                <p style="font-size: 15px;">Adding new data on Emission Category</p>
            </div>
            <button type="button" class="btn-close mb-4" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
            <div class="modal-body">
                <form id="addNewForm" action="{{ route('emission.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="type" class="form-label">Type</label>
                        <select class="form-control" id="type" name="type" required>
                            <option value="food">Food</option>
                            <option value="energy">Energy</option>
                            <option value="transportation">Transportation</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="emission" class="form-label">Emission(The carbon emission input per 1 kg will be divided by 4 by the system to determine 1/4 kg.)</label>
                        <input type="number" step="0.01" class="form-control" id="emission" name="emission" required>
                    </div>
                    <button type="submit" class="btn btn-custom">Save</button>
                </form>
            </div>

        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
