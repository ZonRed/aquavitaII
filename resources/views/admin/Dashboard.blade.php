<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            background-color: #007bff;
        }

        .nav-link {
            color: #fff;
            transition: background-color 0.3s, color 0.3s;
        }

        .nav-link:hover {
            color: #fff;
            background-color: #0056b3;
        }

        .nav-link:active {
            color: #fff;
            background-color: #004494;
        }

        .content-area {
            margin-left: 200px;
            padding: 20px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: static;
                width: 100%;
                height: auto;
                padding: 15px 0;
            }

            .content-area {
                margin-left: 0;
            }
        }

        body {
            background-color: #f8f9fa;
        }

        .fixed-top-right {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 100;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link" href="Dashboard">Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="D_Laporan">View Pesan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="D_Jadwal">Isi Penjadwalan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="D_Jual">Isi Penjualan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="D_Promo">Isi Promo</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ url('/') }}">Home Web</a>
            </li>
        </ul>
    </div>

    <!-- Content area -->
    <section id="dashboard" class="py-5" style="margin-top: 80px;">
        <div class="container-fluid content-area">
            <h2>Welcome to Admin Dashboard</h2>
            <p>Ini adalah halaman admin dashboard.</p>
        </div>
         <!-- user admin tampilan -->
         <div class="position-fixed" style="top: 10px; right: 10px; z-index: 100;">
            <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
            <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
        </div>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
