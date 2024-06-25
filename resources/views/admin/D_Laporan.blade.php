<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - View Pesan</title>

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

        .fixed-top-right {
            position: fixed;
            top: 10px;
            right: 10px;
            z-index: 100;
        }

        @media (max-width: 768px) {
            .fixed-top-right {
                position: static;
                margin-top: 10px;
                text-align: center;
            }

            .table-responsive {
                margin-left: 0;
            }
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

    <!-- Content area for laporan -->
    <section id="laporan" class="py-5" style="margin-top: 80px;">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - View Pesan</h2>
            <p>INI "View Pesan" admin dashboard.</p>
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
            <!-- Keterangan -->
            <div class="col-md-12">
                <h5 class="text-danger">Perhatian!!</h5>
                <p class="text-danger">Cari berdasarkan format yang sudah ada</p>
                <p class="text-danger">Jika ingin resert click logo kalender (di dalam pencarian), di bagian bawah kiri
                    ada "hapus"</p>
                <p class="text-danger">click tulisan tersebut untuk hapus data pencarian/menggunakan "backscpace" satu
                    persatu pada format pencarian </p>
            </div>
            <div class="col-md-3">
                <h3>Pencarian:</h3>
                <!-- Input untuk Pencarian -->
                <div class="input-group">
                    <input type="date" id="searchInput" class="form-control" placeholder="format (tgl-bulan-tahun)">
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Table untuk CRUD hasil laporan -->
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
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Pesan</th>
                    <th>Waktu Input</th>
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
                <!-- Pagination will be inserted here by AJAX -->
            </ul>
        </nav>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- script ajax delete -->
    <script>
        // Function untuk menampilkan SweetAlert setelah berhasil menghapus data individu
        function showConfirmDeleteModal(id) {
            Swal.fire({
                title: 'Konfirmasi Penghapusan',
                text: 'Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request DELETE menggunakan AJAX atau langsung redirect, sesuai kebutuhan
                    window.location.href = `/delete_Laporan/${id}`;
                }
            });
        }

        // Function untuk menampilkan SweetAlert setelah berhasil menghapus semua data
        function showConfirmDeleteAllModal() {
            Swal.fire({
                title: 'Konfirmasi Penghapusan Semua Data',
                text: 'Apakah Anda yakin ingin menghapus semua data? Tindakan ini tidak dapat dibatalkan.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus semua',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Kirim request DELETE menggunakan AJAX atau langsung redirect, sesuai kebutuhan
                    window.location.href = `/delete_all_Laporan`;
                }
            });
        }

        // Ambil data dari session Laravel dan tampilkan SweetAlert
        $(document).ready(function() {
            // Tampilkan SweetAlert setelah berhasil menghapus data individu
            @if (session('success'))
                Swal.fire('Sukses!', '{{ session('success') }}', 'success');
            @elseif (session('error'))
                Swal.fire('Error!', '{{ session('error') }}', 'error');
            @endif

            // Tampilkan SweetAlert setelah berhasil menghapus semua data
            @if (session('success_all'))
                Swal.fire('Sukses!', '{{ session('success_all') }}', 'success');
            @endif
        });
    </script>

   <!-- script ajax table,pagination,dan search -->
    <script>
        $(document).ready(function() {
            let currentPage = 1;
            let query = '';

            function pencarianadmin(page = 1, query = '') {
                $.ajax({
                    url: "{{ route('pencarianadmin') }}",
                    method: "GET",
                    data: {
                        page: page,
                        query: query
                    },
                    success: function(data) {
                        currentPage = data.current_page;
                        let tableRows = '';
                        let laporan = data.data;
                        laporan.forEach((laporan, index) => {
                            let formattedDate = new Date(laporan.created_at).toLocaleDateString(
                                'id-ID', {
                                    day: 'numeric',
                                    month: 'numeric',
                                    year: 'numeric'
                                });
                            tableRows += `
                <tr>
                    <td>${index + 1 + (data.current_page - 1) * data.per_page}</td>
                    <td>${laporan.nama_laporan}</td>
                    <td><a href="https://mail.google.com/mail/?view=cm&fs=1&to=${laporan.email_laporan}" target="_blank">${laporan.email_laporan}</a></td>
                    <td>${laporan.pesan_laporan}</td>
                    <td>${formattedDate}</td>
                    <td>
                        <div class="d-flex gap-2">
                            <button class="btn btn-danger" onclick="showConfirmDeleteModal(${laporan.id})">Delete</button>
                        </div>
                    </td>
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
            pencarianadmin(currentPage, query);

            // Handle pagination click
            $(document).on('click', '#paginationLinks a', function(e) {
                e.preventDefault();
                let page = $(this).data('page');
                pencarianadmin(page, query);
            });

            // Handle search input
            $('#searchInput').on('input', function() {
                query = $(this).val();
                pencarianadmin(1, query); // Fetch from the first page when searching
            });

            // Real-time update every 1 seconds
            setInterval(function() {
                pencarianadmin(currentPage, query);
            }, 1000);
        });
    </script>

</body>

</html>
