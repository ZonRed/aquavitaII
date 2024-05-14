<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Edit Isi Promo</title>

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

    <!-- Content area for Edit promo -->
    <section id="edit-promo" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Edit Isi Promo</h2>

            <!-- user admin tampilan -->
            <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
                <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
                <span style="color: #000; font-weight: bold;">{{Auth::user()->nama ?? ''}}</span>
                <!-- Tambahkan tautan logout di sini -->
                <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
            </div>

            <!-- Card untuk edit isi promo -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/update_Promo/' . $Promo->id) }}" method="POST">
                        @csrf
                        <!-- Input untuk Tanggal mulai promo -->
                        <div class="mb-3">
                            <label for="tanggal_mulai_promo" class="form-label">Tanggal Mulai Promo</label>
                            <input type="date" class="form-control" name="tanggal_mulai_promo" value="{{ $Promo->tanggal_mulai_promo }}" required>
                        </div>

                        <!-- Input untuk Tanggal akhir promo -->
                        <div class="mb-3">
                            <label for="tanggal_akhir_promo" class="form-label">Tanggal Akhir Promo</label>
                            <input type="date" class="form-control" name="tanggal_akhir_promo" value="{{ $Promo->tanggal_akhir_promo }}" required>
                        </div>

                        <!-- Input untuk code promo -->
                        <div class="mb-3">
                            <label for="code_promo" class="form-label">Code Promo</label>
                            <input type="text" class="form-control" name="code_promo" value="{{ $Promo->code_promo }}" required>
                        </div>

                        <!-- Input untuk type promo-->
                        <div class="mb-3">
                            <label for="type_promo" class="form-label">Barang Promo</label>
                            <input type="text" class="form-control" name="type_promo" value="{{ $Promo->type_promo }}" required>
                        </div>

                        <!-- Input untuk info promo-->
                        <div class="mb-3">
                            <label for="info_promo" class="form-label">Info Ppromo</label>
                            <input type="text" class="form-control" name="info_promo" value="{{ $Promo->info_promo }}" required>
                        </div>

                        <!-- Input untuk harga -->
                        <div class="mb-3">
                            <label for="harga_promo" class="form-label">Harga Promo (jika tidak ada ,tidak usah di isi)</label>
                            <input type="text" class="form-control" name="harga_promo" value="{{ $Promo->harga_promo }}">
                        </div>


                        <!-- Tombol Submit -->
                        <input type="submit" value="Simpan" class="btn btn-primary">
                        <!-- Back button -->
                        <a href="{{ url('/D_Promo') }}" class="btn btn-outline-primary">Batal</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
