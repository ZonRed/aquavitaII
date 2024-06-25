<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Isi Promo</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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

    <!-- Content area for promo -->
    <section id="promo" class="py-5" style="margin-top: 80px;">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Isi Promo</h2>
            <p>INI "Isi Promo" admin dashboard.</p>
        </div>
        <!-- user admin tampilan -->
        <div class="position-fixed" style="top: 10px; right: 10px; z-index: 100;">
            <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
            <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
        </div>
    </section>

    <!-- Search bar and alerts -->
    <div class="container-fluid content-area">
        <div class="row mb-3">
            <div class="col-md-12">
                <h5 class="text-danger">Perhatian!!</h5>
                <p class="text-danger">Ketika ingin mencari code promo harap tekan tombol "cari"</p>
                <p class="text-danger">Begitu juga ketika refresh tekan tombol "cari"!</p>
            </div>
            <div class="col-md-3">
                <div class="input-group mb-3">
                    <input type="text" id="searchInput" class="form-control mb-3" placeholder="Search...">
                </div>
            </div>
            <div class="col-md-6">
                <a href="D_InputPromo" class="btn btn-outline-primary">Input</a>
            </div>
        </div>
    </div>

    <!-- Table untuk CRUD Promo -->
    <div class="table-responsive content-area">
        <div class="d-flex justify-content-between mb-2">
            <div></div>
            <div>
                <button class="btn btn-danger" onclick="showConfirmDeleteAllModal()">Delete All</button>
            </div>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal Mulai Promo</th>
                    <th>Tanggal Akhir Promo</th>
                    <th>Code Promo</th>
                    <th>Barang Promo</th>
                    <th>Info Promo</th>
                    <th>Harga Promo(Rupiah)</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="myTable">
                <!-- Data will be inserted here by AJAX -->
            </tbody>
        </table>
    </div>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm" id="paginationLinks">
                <!-- Pagination links will be inserted here by AJAX -->
            </ul>
        </nav>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi penghapusan satu data -->
    <script>
        function showConfirmDeleteModal(id) {
            deleteId = id;
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: "Apakah Anda yakin ingin menghapus data ini?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/delete_Promo/${deleteId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire('Sukses', data.message, 'success');
                                location.reload();
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus promo.', 'error');
                        });
                }
            });
        }
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi penghapusan semua data -->
    <script>
        function showConfirmDeleteAllModal() {
            Swal.fire({
                title: 'Konfirmasi Penghapusan Semua promo',
                text: "Apakah Anda yakin ingin menghapus semua data promo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus semua!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/delete_all_Promo`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire('Sukses', data.message, 'success');
                                location.reload();
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus semua promo.', 'error');
                        });
                }
            });
        }
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi data berhasil diinput -->
    <script>
        let successMessage = '{{ Session::get('success') }}';
        if (successMessage) {
            Swal.fire('Sukses', successMessage, 'success');
        }

        let errorMessage = '{{ Session::get('error') }}';
        if (errorMessage) {
            Swal.fire('Error', errorMessage, 'error');
        }
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi data berhasil diupdate -->
    <script>
        let successMessage = '{{ session('success') }}';
        if (successMessage) {
            Swal.fire('Sukses', successMessage, 'success');
        }

        let errorMessage = '{{ session('error') }}';
        if (errorMessage) {
            Swal.fire('Error', errorMessage, 'error');
        }
    </script>

    <!-- script ajax table,pagination,dan search -->
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let query = '';

            // Function to fetch data via AJAX
            function fetchPromo(page = 1, query = '') {
                $.ajax({
                    url: "{{ route('pencarianadminpromo') }}", // Adjust with your Laravel route
                    method: "GET",
                    data: {
                        page: page,
                        caricodepromoadmin_promo: query // Adjust with your query parameter name
                    },
                    success: function(data) {
                        currentPage = data.current_page;
                        let tableRows = '';

                        // Populate table rows
                        data.data.forEach((p, index) => {
                            tableRows += `
                            <tr>
                                <td>${index + 1 + (data.current_page - 1) * data.per_page}</td>
                                <td>${p.tanggal_mulai_promo}</td>
                                <td>${p.tanggal_akhir_promo}</td>
                                <td>${p.code_promo}</td>
                                <td>${p.type_promo}</td>
                                <td>${p.info_promo}</td>
                                <td>Rp.${parseFloat(p.harga_promo).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&.').replace(/\.00$/, '')}</td>
                                <td>
                                    <div class="d-flex gap-2">
                                        <a href="{{ url('/edit_Promo/') }}/${p.id}" class="btn btn-primary">Edit</a>
                                        <button class="btn btn-danger" onclick="showConfirmDeleteModal(${p.id})">Delete</button>
                                    </div>
                                </td>
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
            fetchPromo(currentPage, query);

            // Handle pagination click
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                fetchPromo(page, query);
            });

            // Handle search input
            $('#searchInput').on('input', function() {
                query = $(this).val();
                fetchPromo(1, query); // Fetch from the first page when searching
            });

            // Real-time update every 1 second (you mentioned every 1 second update)
            setInterval(function() {
                fetchPromo(currentPage, query);
            }, 1000);
        });
    </script>

</body>

</html>
