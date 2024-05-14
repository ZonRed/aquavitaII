<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Tambahkan tautan ke file CSS Bootstrap -->
        {{-- <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}"> --}}

    <!-- Tambahkan tautan ke file JQUERY ajax -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        
    <!-- Tautan awesome font -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">



    <title>Produk Penjualan AQUAVITA II</title>
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">AQUAVITA II</a>
            
         <!-- Tombol Kembali -->
         <div class=" d-flex gap-2">
            <a class="btn btn-light mx-2" href="{{ url('/') }}">
                <i class="fa-solid fa-house"></i> 
            </a>
            
        </div>
        </div>
    </nav>

    <div class="container mt-5 my-5 text-center">
        <!-- Konten Halaman Produk Penjualan -->
        <div class="row justify-content-center" style="margin-top: 80px;">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ asset('image/produk_penjualan.png') }}"  class="card-img-top" alt="logo">
                    <div class="card-body">
                        <!-- Tabel stock -->
                         <div class="container mt-5">
                            <div class="card-body">
                                <h1>~Produk Penjualan AQUAVITA II~</h1>
                                <h5 class="text-danger">perhatian!!</h5>
                                <p class="text-danger">ketika ingin mencari code barang harap tekan tombol "cari"</p> 
                                <p class="text-danger">begitu juga ketika refresh tekan tombol "cari"!</p>
                            <div class="card">
                                 <!-- fitur pencarian -->
                                 <form action="{{ url('/Jual') }}" method="GET" id="searchForm">
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Search Code Barang.." id="searchInput" name="caricodepengguna_jual">
                                        <button class="btn btn-outline-primary" type="submit">Cari</button>
                                    </div>
                                </form>
                                
                                
                            <div class="table-responsive">
                                 <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Tanggal</th>
                                                <th>Code Barang</th>
                                                <th>Type</th>
                                                <th>Harga</th>
                                                <th>Stock</th>
                                                <th>Jumlah Stock</th>
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
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
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
                           <!-- Tombol Kembali ke Halaman Utama -->
                    <div class="container mt-3">
                    <div class="d-flex gap-10 justify-content-center">
                        <a href="{{url('/')}}" class="btn btn-primary mx-5">
                            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                       </a>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
    
 <!-- Footer -->
 <footer class="bg-primary text-light text-center py-3">
    <p>&copy; 2024 AQUAVITA II</p>
</footer>

    {{-- <!-- Tambahkan script pencarian -->
    <script>
    // Fungsi untuk melakukan pencarian
    function searchTable() {
        // Mendapatkan nilai input pencarian
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("searchInput");
        filter = input.value.toUpperCase();
        table = document.getElementsByTagName("table")[0];
        tr = table.getElementsByTagName("tr");

        // Melakukan filter pada baris tabel
        for (i = 1; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0]; // Kolom dengan tanggal pertandingan
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

    // Mendengarkan perubahan pada input pencarian
    document.getElementById("searchInput").addEventListener("keyup", searchTable);
</script> --}}


        <!-- Tambahkan tautan ke file JavaScript Bootstrap -->
        {{-- <!-- <link rel="stylesheet" href="{{asset('js/bootstrap.js')}}">
        <link rel="stylesheet" href="{{asset('js/bootstrap.min.js')}}"> --> --}}

        <!-- Tambahkan tautan ke file JavaScript Bootstrap -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>
