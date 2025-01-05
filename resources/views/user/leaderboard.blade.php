<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">
    <style>
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

        .podium {
            display: flex;
            justify-content: center;
            align-items: flex-end;
            gap: 15px;
            margin-bottom: 30px;
        }

        .podium-item {
            text-align: center;
            width: 120px;
            background: #e0e0e0;
            border-radius: 10px 10px 0 0;
            padding: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .first {
            background: gold;
            height: 200px;
        }

        .second {
            background: silver;
            height: 170px;
        }

        .third {
            background: #cd7f32;
            height: 150px;
        }

        .podium-content {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }

        .podium-rank {
            font-size: 1.2rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .podium-name {
            font-weight: 500;
            margin-bottom: 5px;
            word-break: break-word;
        }

        .podium-score {
            font-size: 0.9rem;
            margin-bottom: 5px;
        }

        .detail-btn {
            width: 90%;
            margin: 0 auto;
            background-color: #0dcaf0;
            border-color: #0dcaf0;
            color: white;
        }

        .detail-btn:hover {
            background-color: #0bb5d8;
            border-color: #0bb5d8;
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
    <div class="container mt-5">
        <!-- Podium Section -->
        <div class="podium">
            @if(isset($histories[1]))
                <div class="podium-item first">
                    <div class="podium-content">
                        <div class="podium-rank">1st</div>
                        <div class="podium-name">{{ $histories[1]->user->name }}</div>
                        <div class="podium-score">{{ $histories[1]->skor->emission_km + $histories[1]->skor->emission_kwh + $histories[1]->skor->emission_food }} CO₂e/kg</div>
                    </div>
                    <button class="btn btn-sm detail-btn detail-button" data-bs-toggle="modal" data-bs-target="#historyModal"
                            data-date="{{ $histories[1]->created_at->format('Y-m-d H:i') }}"
                            data-user="{{ $histories[1]->user->name }}"
                            data-emission-food="{{ $histories[1]->skor->emission_food }}"
                            data-emission-kwh="{{ $histories[1]->skor->emission_kwh }}"
                            data-emission-km="{{ $histories[1]->skor->emission_km }}">
                        Details
                    </button>
                </div>
            @endif

            @if(isset($histories[2]))
                <div class="podium-item second">
                    <div class="podium-content">
                        <div class="podium-rank">2nd</div>
                        <div class="podium-name">{{ $histories[2]->user->name }}</div>
                        <div class="podium-score">{{ $histories[2]->skor->emission_km + $histories[2]->skor->emission_kwh + $histories[2]->skor->emission_food }} CO₂e/kg</div>
                    </div>
                    <button class="btn btn-sm detail-btn" data-bs-toggle="modal" data-bs-target="#historyModal"
                            data-date="{{ $histories[2]->created_at->format('Y-m-d H:i') }}"
                            data-user="{{ $histories[2]->user->name }}"
                            data-emission-food="{{ $histories[2]->skor->emission_food }}"
                            data-emission-kwh="{{ $histories[2]->skor->emission_kwh }}"
                            data-emission-km="{{ $histories[2]->skor->emission_km }}">
                        Details
                    </button>
                </div>
            @endif

            @if(isset($histories[3]))
                <div class="podium-item third">
                    <div class="podium-content">
                        <div class="podium-rank">3rd</div>
                        <div class="podium-name">{{ $histories[3]->user->name }}</div>
                        <div class="podium-score">{{ $histories[3]->skor->emission_km + $histories[3]->skor->emission_kwh + $histories[3]->skor->emission_food }} CO₂e/kg</div>
                    </div>
                    <button class="btn btn-sm detail-btn detail-button" data-bs-toggle="modal" data-bs-target="#historyModal"
                            data-date="{{ $histories[3]->created_at->format('Y-m-d H:i') }}"
                            data-user="{{ $histories[3]->user->name }}"
                            data-emission-food="{{ $histories[3]->skor->emission_food }}"
                            data-emission-kwh="{{ $histories[3]->skor->emission_kwh }}"
                            data-emission-km="{{ $histories[3]->skor->emission_km }}">
                        Details
                    </button>
                </div>
            @endif

            @if(empty($histories))
                <div class="no-data-message">
                    <p>No leaderboard data available. Start tracking your carbon footprint to see your rank here.</p>
                </div>
            @endif
        </div>


        <!-- Table Section -->
        <table class="table table-bordered" style="margin-top:50px">
            <thead>
            <tr>
                <th>Rank</th>
                <th>User</th>
                <th>Daily Score (CO₂e/kg)</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($histories->slice(3, 7) as $index => $history)
                <tr>
                    <td>{{ $index }}</td>
                    <td>{{ $history->user->name }}</td>
                    <td>{{ $history->skor->emission_km + $history->skor->emission_kwh + $history->skor->emission_food }}</td>
                    <td>
                        <button class="btn btn-sm detail-btn detail-button" data-bs-toggle="modal" data-bs-target="#historyModal"
                                data-date="{{ $history->created_at->format('Y-m-d H:i') }}"
                                data-user="{{ $history->user->name }}"
                                data-emission-food="{{ $history->skor->emission_food }}"
                                data-emission-kwh="{{ $history->skor->emission_kwh }}"
                                data-emission-km="{{ $history->skor->emission_km }}"
                                style="width: auto;">
                            Details
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="historyModal" tabindex="-1" aria-labelledby="historyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="historyModalLabel">History Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Date:</strong> <span id="modalDate"></span></p>
                    <p><strong>User:</strong> <span id="modalUser"></span></p>
                    <p><strong>Emission Food:</strong> <span id="modalEmissionFood"></span></p>
                    <p><strong>Emission KWh:</strong> <span id="modalEmissionKwh"></span></p>
                    <p><strong>Emission KM:</strong> <span id="modalEmissionKm"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const detailButtons = document.querySelectorAll('.detail-button');

            detailButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Get data attributes
                    const date = this.getAttribute('data-date');
                    const user = this.getAttribute('data-user');
                    const emissionFood = this.getAttribute('data-emission-food');
                    const emissionKwh = this.getAttribute('data-emission-kwh');
                    const emissionKm = this.getAttribute('data-emission-km');

                    // Update modal content
                    document.getElementById('modalDate').textContent = date;
                    document.getElementById('modalUser').textContent = user;
                    document.getElementById('modalEmissionFood').textContent = emissionFood;
                    document.getElementById('modalEmissionKwh').textContent = emissionKwh;
                    document.getElementById('modalEmissionKm').textContent = emissionKm;
                });
            });
        });
    </script>
</body>
</html>
