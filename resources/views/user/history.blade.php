<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>History</title>
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
                        <a class="nav-link" href="#">
                            <i class="fa-solid fa-file"></i>
                            History
                        </a>
                    </li>
                    <li class="nav-item me-3">
                        <a class="nav-link" href="#">
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
    <div class="p-5">
        <div class="row mt-5 p-2">
        <table>
            <thead style="background-color: #136370; color: white;">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Date</th>
                    <th scope="col">Rekomendasi</th>
                    <th scope="col">User</th>
                    <th scope="col">Emission</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($histories as $history) <!-- Ubah $history menjadi $histories -->
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}</td> <!-- Tampilkan tanggal dengan format yang sesuai -->
                        <td>{{ $history->rekomendasi }}</td> <!-- Menampilkan rekomendasi -->
                        <td>{{ $history->user->name }}</td> <!-- Menampilkan nama user yang terkait -->
                        <td>{{ $history->skor->emission_food + $history->skor->emission_km+$history->skor->emission_kwh}}</td> <!-- Menampilkan data skor terkait -->
                        <td>
                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#historyModal"
                                data-date="{{ \Carbon\Carbon::parse($history->date)->format('d-m-Y') }}"
                                data-rekomendasi="{{ $history->rekomendasi }}"
                                data-user="{{ $history->user->name }}"
                                data-emission_food="{{ $history->skor->emission_food }}"
                                data-emission_kwh="{{ $history->skor->emission_kwh }}"
                                data-emission_km="{{ $history->skor->emission_km }}">
                                Detail
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        </div>
    </div>
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="historyModalLabel">History Detail</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                <div class="col-6">
                    <strong>Date:</strong>
                    <div id="modalDate"></div>
                </div>
                <div class="col-6">
                    <strong>Rekomendasi:</strong>
                    <div id="modalRekomendasi"></div>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <strong>User:</strong>
                    <div id="modalUser"></div>
                </div>
                <div class="col-6">
                    <strong>Emission Food:</strong>
                    <div id="modalEmissionFood"></div>
                </div>
                </div>
                <div class="row">
                <div class="col-6">
                    <strong>Emission KWh:</strong>
                    <div id="modalEmissionKwh"></div>
                </div>
                <div class="col-6">
                    <strong>Emission KM:</strong>
                    <div id="modalEmissionKm"></div>
                </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
<script>
    // Event listener untuk membuka modal dan mengisi data
    const detailButtons = document.querySelectorAll('.btn-info');
    detailButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Ambil data dari attributes
            const date = this.getAttribute('data-date');
            const rekomendasi = this.getAttribute('data-rekomendasi');
            const user = this.getAttribute('data-user');
            const emissionFood = this.getAttribute('data-emission_food');
            const emissionKwh = this.getAttribute('data-emission_kwh');
            const emissionKm = this.getAttribute('data-emission_km');

            // Isi modal dengan data
            document.getElementById('modalDate').textContent = date;
            document.getElementById('modalRekomendasi').textContent = rekomendasi;
            document.getElementById('modalUser').textContent = user;
            document.getElementById('modalEmissionFood').textContent = emissionFood;
            document.getElementById('modalEmissionKwh').textContent = emissionKwh;
            document.getElementById('modalEmissionKm').textContent = emissionKm;
        });
    });
</script>
</html>
