<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Isi Penjualan</title>

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
    <section id="input-jual" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Input Isi Penjualan</h2>
    
        <!-- user admin tampilan -->
        <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
            <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
            <span style="color: #000; font-weight: bold;">{{Auth::user()->nama ?? ''}}</span>
            <!-- Tambahkan tautan logout di sini -->
            <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
        </div>

            <!-- Card untuk input hasil pertandingan -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('SaveJual') }}" method="POST">
                        @csrf
                        <!-- Input untuk Tanggal -->
                        <div class="mb-3">
                            <label for="tanggal_jual" class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal_jual" required>
                        </div>

                        <!-- Input untuk code_barang -->
                        <div class="mb-3">
                            <label for="code_jual" class="form-label">Code Barang</label>
                            <input type="text" class="form-control" name="code_jual" required>
                        </div>

                        <!-- Input untuk type -->
                        <div class="mb-3">
                            <label for="type_jual" class="form-label">Type</label>
                            <input type="text" class="form-control" name="type_jual" required>
                        </div>

                        <!-- Input untuk harga -->
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga_jual" required>
                        </div>

                        <!-- Input untuk stock -->
                        <div class="mb-3">
                            <label for="stock_jual" class="form-label">Stock</label>
                            <select class="form-select" name="stock_jual" required>
                                <option value="Ada">Ada</option>
                                <option value="Kosong">Kosong</option>
                            </select>
                        </div>
                          <!-- Input untuk jumlah barang -->
                          <div class="mb-3">
                            <label for="jumlah_jual" class="form-label">Jumlah Stock (jika tidak ada ,tidak usah di isi)</label>
                            <input type="text" class="form-control" name="jumlah_jual">
                        </div>

                        <!-- Tombol Submit -->
                        <input type="submit" value="Simpan" class="btn btn-primary">
                          <!-- Back button -->
                        <a href="D_Jual" class="btn btn-outline-primary">View Data</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
