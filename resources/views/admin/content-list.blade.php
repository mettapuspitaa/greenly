<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Manage Emission Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
      /* Navbar brand image */
      .navbar-brand img {
          height: 70px;
          max-width: 100%;
          object-fit: contain;
      }

      body {
          background-color: #F2F5F6;
      }

      .btn-custom {
          background-color: #136370;
          color: #ffffff;
          border: 1px solid #136370;
      }
      .btn-custom:hover {
          background-color: #0f4f59;
      }

      .alert-dismissible .btn-close {
          position: relative;
          top: 0;
          right: 0;
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand me-5" href="#">
                <img src="assets/navlogo.png" alt="Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item me-3">
                        <a class="nav-link" href="{{ route('emission.index') }}">
                            <i class="fa-solid fa-shoe-prints"></i> Emission Category
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="/content-list">
                            <i class="fa-solid fa-image"></i> Manage Education Content
                        </a>
                    </li>
                </ul>
                <div class="d-flex align-items-center">
                    <a href="{{ route('profile') }}" class="nav-link me-3">
                        {{ Auth::user()->name }}
                        <img src="assets/avatar.png" alt="Profile Avatar" class="rounded-circle" style="height: 40px; width: 40px;">
                    </a>
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link text-dark text-decoration-none p-0">
                            <i class="fa-solid fa-right-from-bracket fa-lg"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    <div class="mt-1 p-2">
        @if(session('status') && session('message'))
            <div class="alert alert-{{ session('status') }} alert-dismissible fade show" role="alert">
                {{ session('message') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
    </div>

    <!-- Main Content -->
    <div class="p-5">
        <div class="d-flex justify-content-between align-items-center">
            <h2>Manage Contents</h2>
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#addNewModal">Add New</button>
        </div>

        <div class="row mt-5 p-2">
            <table>
                <thead style="background-color: #136370; color: white;">
                    <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Path</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($contents as $key => $content)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $content->name }}</td>
                            <td>{{ $content->description }}</td>
                            <td>{{ $content->path }}</td>
                            <td>{{ $content->date }}</td>
                            <td>
                                <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $content->content_id }}">Edit</button>
                                <form action="{{ route('content.destroy', $content->content_id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">No contents found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add Modal -->
    <div class="modal fade" id="addNewModal" tabindex="-1" aria-labelledby="addNewModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addNewModalLabel">Add New Content</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('content.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="path" class="form-label">File</label>
                    <input type="file" class="form-control" id="path" name="path" required>
                </div>
                <button type="submit" class="btn btn-custom">Save</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Modals -->
    @foreach($contents as $content)
        <div class="modal fade" id="editModal{{ $content->content_id }}" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editModalLabel">Edit Content</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('content.update', $content->content_id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{ $content->name }}" required>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" name="description" required>{{ $content->description }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="path" class="form-label">File</label>
                                <input type="file" class="form-control" name="path">
                            </div>
                            <button type="submit" class="btn btn-success">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>
