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



    <title>Jadwal Operasional AQUAVITA II</title>
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
                    <img src="{{ asset('image/jadwal_operasional.png') }}" class="card-img-top" alt="logo">
                    <div class="card-body">
                        <!-- Tabel stock -->
                        <div class="container mt-5">
                            <div class="card-body">
                                <h1>~Jadwal Operasional AQUAVITA II~</h1>
                                <h5 class="text-danger">Perhatian!!</h5>
                                <p class="text-danger">Cari Berdasarakan "Nama Hari"!.</p>
                                <div class="card">
                                    <!-- fitur pencarian -->
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Cari Nama Hari..."
                                            id="searchInput" name="cariharipengguna_jadwal">
                                    </div>


                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Hari</th>
                                                    <th>Jam Buka (WIB)</th>
                                                    <th>Jam Tutup (WIB)</th>
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

            function fetchJadwal(page = 1, query = '') {
                $.ajax({
                    url: "{{ route('pencarianpenggunajadwal') }}",
                    method: "GET",
                    data: {
                        page: page,
                        cariharipengguna_jadwal: query
                    },
                    success: function(data) {
                        currentPage = data.current_page;
                        let tableRows = '';
                        let jadwal = data.data;
                        jadwal.forEach((item, index) => {
                            tableRows += `
                            <tr>
                                <td>${index + 1 + (data.current_page - 1) * data.per_page}</td>
                                <td>${item.hari_jadwal}</td>
                                <td>${item.buka_jadwal}</td>
                                <td>${item.tutup_jadwal}</td>
                            </tr>`;
                        });
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
                        for (let i = 1; i <= data.last_page; i++) {
                            paginationLinks += `<li class="page-item ${i === data.current_page ? 'active' : ''}">
                            <a class="page-link" href="#" data-page="${i}">${i}</a>
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
            fetchJadwal(currentPage, query);

            // Handle pagination click
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                fetchJadwal(page, query);
            });

            // Handle search input
            $('#searchInput').on('input', function() {
                query = $(this).val();
                fetchJadwal(1, query); // Fetch from the first page when searching
            });
            // Real-time update every 1 seconds
            setInterval(function() {
                fetchJadwal(currentPage, query);
            }, 1000);
        });
    </script>


</body>

</html>
