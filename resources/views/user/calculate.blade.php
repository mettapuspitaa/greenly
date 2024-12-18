<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Calculate Emission</title>
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
      }
        .btn-outline-custom {
            background-color: #136370;
            color: #ffffff;
            border-color: #136370;
        }
        .btn-outline-custom:hover {
            background-color: transparent;
            color: #136370;
            border: 1px solid #136370;
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
        <form action="">
            @csrf
            <div class="row container-fluid justify-content-center ms-1">
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title p-3">Transportation</h5>
                            <div class="row container-fluid align-items-center">
                                <div class="col-8">
                                    <select class="form-select emission-category" id="transportation" name="transportation">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" placeholder="0" name="">
                                </div>
                                <div class="col-1">
                                    <label class="form-label mb-0">KM</label>
                                </div>
                            </div>
                            <center>
                                <button class="btn btn-outline-custom m-3" id="addmore">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <button class="btn btn-outline-custom m-3" id="remove1">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title p-3">Energy</h5>
                            <div class="row container-fluid align-items-center" name="selects">
                                <div class="col-8">
                                    <select class="form-select emission-category" id="energy" name="energy">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                                <div class="col-3">
                                    <input type="number" class="form-control" placeholder="0" name="">
                                </div>
                                <div class="col-1">
                                    <label class="form-label mb-0">KWH</label>
                                </div>
                            </div>
                            <center>
                                <button class="btn btn-outline-custom m-3" id="addmore">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <button class="btn btn-outline-custom m-3" id="remove1">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
                <div class="col-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title p-3">Food</h5>
                            <div class="row container-fluid align-items-center">
                                <div class="col">
                                    <select class="form-select emission-category" id="food" name="food">
                                        <option value="">Loading...</option>
                                    </select>
                                </div>
                            </div>
                            <center>
                                <button class="btn btn-outline-custom m-3" id="addmore">
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                                <button class="btn btn-outline-custom m-3" id="remove1">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row p-5 m-5">
                <button class="btn btn-outline-custom" type="submit" id="calc">Calculate</button>
            </div>
        </form>
        <!-- Modal for Emission Calculation Result -->
        <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Total Emission</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Your total emission is: <span id="totalEmission">0</span> kg CO₂
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const calculateButton = document.querySelector('button[id="calc"]');

                calculateButton.addEventListener('click', function (e) {
                    e.preventDefault();

                    let totalEmission = 0;

                    // Loop melalui setiap kartu kategori
                    document.querySelectorAll('.card').forEach(card => {
                        card.querySelectorAll('.row').forEach(row => {
                            const categoryType = row.querySelector('.emission-category');
                            const valueInput = row.querySelector('input[type="number"]');

                            if (categoryType && categoryType.value) {
                                // Mendapatkan faktor emisi dari opsi yang dipilih
                                const emissionFactor = parseFloat(categoryType.options[categoryType.selectedIndex].getAttribute('data-emission-factor')) || 0;

                                // Mendapatkan nilai input pengguna
                                let userValue;

                                // Jika kategori adalah 'food', userValue bernilai 1
                                if (categoryType.id === 'food') {
                                    userValue = 1;
                                } else if (valueInput && valueInput.value) {
                                    userValue = parseFloat(valueInput.value);
                                } else {
                                    userValue = 0;
                                }

                                // Menghitung emisi dan menambahkannya ke total
                                totalEmission += emissionFactor * userValue;
                            }
                        });
                    });

                    // Menampilkan total emisi di dalam modal
                    document.getElementById('totalEmission').textContent = totalEmission.toFixed(2);
                    const resultModal = new bootstrap.Modal(document.getElementById('resultModal'));
                    resultModal.show();
                });


                // Mengisi dropdown berdasarkan data dari backend
                fetch('/emission-all-categories')
                    .then(response => response.json())
                    .then(data => {
                        for (const [type, categories] of Object.entries(data)) {
                            const dropdown = document.getElementById(type);
                            if (dropdown) {
                                dropdown.innerHTML = '<option value="">Select Category</option>';
                                for (const id in categories) {
                                    const option = document.createElement('option');
                                    option.value = id;
                                    option.textContent = categories[id]['name'];
                                    option.setAttribute('data-emission-factor', categories[id].emission);
                                    dropdown.appendChild(option);
                                }
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error loading categories:', error);
                        document.querySelectorAll('.emission-category').forEach(dropdown => {
                            dropdown.innerHTML = '<option value="">Failed to load</option>';
                        });
                    });

                // Tambah dan hapus baris dalam kategori
                document.querySelectorAll('#addmore').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const cardBody = button.closest('.card-body');
                        const originalRow = cardBody.querySelector('.row');
                        const newRow = originalRow.cloneNode(true);

                        newRow.querySelectorAll('input').forEach(input => input.value = '');
                        newRow.querySelectorAll('select').forEach(select => select.selectedIndex = 0);

                        cardBody.appendChild(newRow);
                    });
                });

                document.querySelectorAll('#remove1').forEach(button => {
                    button.addEventListener('click', function (e) {
                        e.preventDefault();
                        const cardBody = button.closest('.card-body');
                        const rows = cardBody.querySelectorAll('.row');

                        if (rows.length > 1) {
                            rows[rows.length - 1].remove();
                        } else {
                            alert("You must have at least one row!");
                        }
                    });
                });
            });
        </script>
    </body>
</html> 
