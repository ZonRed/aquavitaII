<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Isi Penjualan</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

     <!-- Tambahkan tautan ke file JQUERY ajax -->
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

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


    
    <!-- Content area for jual -->
    <section id="jual" class="py-5" style="margin-top: 80px;">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Isi Penjualan</h2>
            <p>INI "Isi Penjualan" admin dashboard.</p>
        </div>
       <!-- user admin tampilan -->
            <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
                <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
                <span style="color: #000; font-weight: bold;">{{Auth::user()->nama ?? ''}}</span>
                <!-- Tambahkan tautan logout di sini -->
                <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
            </div>
              <div style="margin-top: 20px;">
        <a href="javascript:history.back()" class="btn btn-secondary">Kembali</a>
    </div>
    </section>

    <!-- Table untuk CRUD isi penjualan -->
    <table class="table table-bordered" style="margin-left: 220px; padding: 20px;">
        <!-- Search bar -->
        <div class="container-fluid content-area">
            <div class="row mb-3">
                 <!-- Keterangan -->
                 <div class="col-md-12">
                    <h5 class="text-danger">perhatian!!</h5>
                    <p class="text-danger">ketika ingin mencari code barang harap tekan tombol "cari"</p> 
                    <p class="text-danger">begitu juga ketika refresh tekan tombol "cari"!</p>
                </div>
                <div class="col-md-3">
                    <div class="input-group">
                        <!-- fitur pencarian -->
                        <form action="{{ url('/D_Jual') }}" method="GET" id="searchForm">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Search Code Barang.." id="searchInput" name="caricodeadmin_jual">
                                <button class="btn btn-outline-primary" type="submit">Cari</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <!-- Back button -->
                    <a href="D_InputJual" class="btn btn-outline-primary">Input</a>
                </div>
            </div>
        </div>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Code Barang</th>
                <th>Type</th>
                <th>Ukuran</th>
                <th>Harga</th>
                <th>Stock</th>
                <th>Jumlah Stock</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="myTable">
            @foreach ($Jual as $j)
            <tr>
                <td>{{$j->tanggal_jual}}</td>
                <td>{{$j->code_jual}}</td>
                <td>{{$j->type_jual}}</td>
                <td>{{$j->harga_jual}}</td>
                <td>{{$j->stock_jual}}</td>
                <td>{{$j->jumlah_jual}}</td>
                <td>
                <a href="{{ url('/edit_Jual/' . $j->id) }}" class="btn btn-primary">Edit</a>
                <a href="{{ url('/delete_Jual/' . $j->id) }}" class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

<!-- Pagination Links -->
<div class="d-flex justify-content-center mt-3">
    <nav aria-label="Page navigation">
        <ul class="pagination pagination-sm">

            {{-- Previous Page Link --}}
            @if ($Jual->onFirstPage())
                <li class="page-item disabled">
                    <span class="page-link">&laquo;</span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $Jual->previousPageUrl() }}" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($Jual->getUrlRange(1, $Jual->lastPage()) as $page => $url)
                <li class="page-item {{ $page == $Jual->currentPage() ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach

            {{-- Next Page Link --}}
            @if ($Jual->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $Jual->nextPageUrl() }}" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            @else
                <li class="page-item disabled">
                    <span class="page-link">&raquo;</span>
                </li>
            @endif

        </ul>
    </nav>
</div>



    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
