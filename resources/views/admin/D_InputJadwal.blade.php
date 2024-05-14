<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Isi Penjadwalan</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <style>
        .sidebar {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            z-index: 100;
            padding: 48px 0;
            box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.1);
            background-color: #007bff; /* Warna merah yang sesuai dengan tema */
        }

        .nav-link {
            color: #fff; /* Warna teks putih untuk kontras */
        }

        .nav-link:hover {
            color: #fff; /* Warna teks putih untuk kontras */
        }

        .content-area {
            margin-left: 200px;
            padding: 20px;
        }

        body {
            background-color: #f8f9fa; /* Warna latar belakang yang sesuai dengan tema */
        }
        .card {
            max-width: 1000px; /* Set your desired maximum width for the card */
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
    <!-- Content area for Input jual -->
    <section id="input-jadwal" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Input Isi Penjadwalan</h2>
    
        <!-- user admin tampilan -->
        <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
            <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
            <span style="color: #000; font-weight: bold;">{{Auth::user()->nama ?? ''}}</span>
            <!-- Tambahkan tautan logout di sini -->
            <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
        </div>

            <!-- Card untuk input jadwal -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('SaveJadwal') }}" method="POST">
                        @csrf
                        <!-- Input untuk Hari -->
                        <div class="mb-3">
                            <label for="hari_jadwal" class="form-label">Hari</label>
                            <select class="form-select" id="hari_jadwal" name="hari_jadwal" required>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                        </div>

                        <!-- Input untuk waktu buka -->
                        <div class="mb-3">
                            <label for="buka_jadwal" class="form-label">Waktu Buka</label>
                            <input type="time" class="form-control" id="buka_jadwal" name="buka_jadwal" required>
                        </div>

                        <!-- Input untuk waktu tutup -->
                        <div class="mb-3">
                            <label for="tutup_jadwal" class="form-label">Waktu Tutup</label>
                            <input type="time" class="form-control" id="tutup_jadwal" name="tutup_jadwal" required>
                        </div>

                        <!-- Tombol Submit -->
                        <input type="submit" value="Simpan" class="btn btn-primary">
                          <!-- Back button -->
                        <a href="D_Jadwal" class="btn btn-outline-primary">View Data</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
