<nav class="navbar navbar-expand-lg bg-primary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="/dashboard" class="nav-link text-white" style="text-align: center">
                        <i class="bi bi-house-door-fill"></i>
                        <br>Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/dashboard/kriteria" style="text-align: center">
                        <i class="bi bi-bar-chart-line-fill"></i>
                        <br>Kriteria
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false" style="text-align: center">
                        <i class="bi bi-clipboard2-data-fill"></i>
                        <br>Input Data
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/dashboard/input-bobot">Input Bobot</a></li>
                        <li><a class="dropdown-item" href="/dashboard/input-kayu">Input Kayu</a></li>
                    </ul>
                </li>
                <li class="nav-item"><a href="/dashboard/perhitungan" class="nav-link text-white"
                        style="text-align: center">
                        <i class="bi bi-calculator-fill"></i>
                        <br>Perhitungan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/dashboard/laporan" style="text-align: center">
                        <i class="bi bi-file-text-fill"></i>
                        <br>Laporan
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <form action="/logout" method="GET">
                        @csrf
                        <div class="d-flex justify-content-center">
                        <button type="submit" href="/logout" class="nav-link text-white btn border-0">
                            <i class="bi bi-box-arrow-right"></i>
                            <br>logout
                        </button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
