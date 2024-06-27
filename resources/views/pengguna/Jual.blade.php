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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">


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
                    <img src="{{ asset('image/produk_penjualan.png') }}" class="card-img-top" alt="logo">
                    <div class="card-body">
                        <!-- Tabel stock -->
                        <div class="container mt-5">
                            <div class="card-body">
                                <h1>~Produk Penjualan AQUAVITA II~</h1>
                                <h5 class="text-danger">Perhatian!!</h5>
                                <p class="text-danger">Harga barang dan Stock bisa berganti sewaktu - waktu!</p>
                                <div class="card">
                                    <!-- fitur pencarian -->
                                    <h5 class="text-danger">Pencarian:</h5>
                                    <p class="text-danger">Cari Berdasarakan "Nama Barang"!</p>
                                    <div class="input-group mb-3">
                                        <input type="text" id="searchInput" class="form-control"
                                            placeholder="Cari Nama Barang...">
                                    </div>


                                    <!-- table -->
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Tanggal</th>
                                                    <th>Code Barang</th>
                                                    <th>Type barang</th>
                                                    <th>Harga(Rupiah)</th>
                                                    <th>Stock</th>
                                                    <th>Jumlah Stock</th>
                                                </tr>
                                            </thead>
                                            <tbody id="myTable">
                                                <!-- Data will be inserted here by AJAX -->
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- Pagination Links -->
                            <div class="d-flex justify-content-center mt-3">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination pagination-sm" id="paginationLinks">
                                        <!-- Pagination will be inserted here by AJAX -->
                                    </ul>
                                </nav>
                            </div>
                            <!-- Tombol Kembali ke Halaman Utama -->
                            <div class="container mt-3">
                                <div class="d-flex gap-10 justify-content-center">
                                    <a href="{{ url('/') }}" class="btn btn-primary mx-5">
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

    <!-- Tambahkan tautan ke file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- script ajax table,pagination,dan search -->
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let query = '';

            // Function to fetch data via AJAX
            function fetchJual(page = 1, query = '') {
                $.ajax({
                    url: "{{ route('pencarianpenggunajual') }}", // Adjust with your Laravel route
                    method: "GET",
                    data: {
                        page: page,
                        caricodejualpengguna_jual: query // Adjust with your query parameter name
                    },
                    success: function(data) {
                        currentPage = data.current_page;
                        let tableRows = '';

                        // Populate table rows
                        data.data.forEach((j, index) => {
                            tableRows += `
                        <tr>
                            <td>${index + 1 + (data.current_page - 1) * data.per_page}</td>
                            <td>${j.tanggal_jual}</td>
                            <td>${j.code_jual}</td>
                            <td>${j.type_jual}</td>
                            <td>Rp.${parseFloat(j.harga_jual).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/, '')}</td>
                            <td>${j.stock_jual}</td>
                            <td>${j.jumlah_jual}</td>
                        </tr>`;
                        });
                         // Update table body
                         $('#myTable').html(tableRows);

                       // Pagination Links
                        let paginationLinks = '';

                        // First Page link
                        paginationLinks += `<li class="page-item ${data.current_page === 1 ? 'disabled' : ''}">
                            <a class="page-link" href="#" data-page="1" aria-label="First">
                                <span aria-hidden="true">&laquo;&laquo;</span>
                            </a>
                        </li>`;

                        // Previous Page link
                        if (data.current_page > 1) {
                            paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${data.current_page - 1}" aria-label="Previous">
                                    <span aria-hidden="true">&laquo;</span>
                                </a>
                            </li>`;
                        } else {
                            paginationLinks += `<li class="page-item disabled">
                                <span class="page-link">&laquo;</span>
                            </li>`;
                        }

                        // Page numbers
                        let startPage = Math.max(data.current_page - 2, 1);
                        let endPage = Math.min(data.current_page + 2, data.last_page);

                        if (startPage > 1) {
                            paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="1">1</a>
                            </li>`;
                            if (startPage > 2) {
                                paginationLinks += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                            }
                        }

                        for (let i = startPage; i <= endPage; i++) {
                            paginationLinks += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                                <a class="page-link" href="#" data-page="${i}">${i}</a>
                            </li>`;
                        }

                        if (endPage < data.last_page) {
                            if (endPage < data.last_page - 1) {
                                paginationLinks += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                            }
                            paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${data.last_page}">${data.last_page}</a>
                            </li>`;
                        }

                        // Next Page link
                        if (data.current_page < data.last_page) {
                            paginationLinks += `<li class="page-item">
                                <a class="page-link" href="#" data-page="${data.current_page + 1}" aria-label="Next">
                                    <span aria-hidden="true">&raquo;</span>
                                </a>
                            </li>`;
                        } else {
                            paginationLinks += `<li class="page-item disabled">
                                <span class="page-link">&raquo;</span>
                            </li>`;
                        }

                        // Last Page link
                        paginationLinks += `<li class="page-item ${data.current_page === data.last_page ? 'disabled' : ''}">
                            <a class="page-link" href="#" data-page="${data.last_page}" aria-label="Last">
                                <span aria-hidden="true">&raquo;&raquo;</span>
                            </a>
                        </li>`;

                        $('#paginationLinks').html(paginationLinks);
                    }
                });
            }

            // Initial fetch
            fetchJual(currentPage, query);

            // Handle pagination click
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                fetchJual(page, query);
            });

            // Handle search input
            $('#searchInput').on('input', function() {
                query = $(this).val();
                fetchJual(1, query); // Fetch from the first page when searching
            });

            // Real-time update every 1 second (you mentioned every 1 second update)
            setInterval(function() {
                fetchJual(currentPage, query);
            }, 1000);
        });
    </script>

</body>

</html>
