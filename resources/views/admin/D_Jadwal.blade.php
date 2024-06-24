<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Isi Penjadwalan</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tambahkan tautan ke file JQUERY ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

    <!-- Content area for jadwal -->
    <section id="jadwal" class="py-5" style="margin-top: 80px;">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Isi Penjadwalan</h2>
            <p>INI "Isi Penjadwalan" admin dashboard.</p>
        </div>
        <!-- user admin tampilan -->
        <div class="position-fixed" style="top: 10px; right: 10px; z-index: 100;">
            <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
            <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
        </div>
    </section>

    <!-- Table untuk CRUD isi penjadwalan -->
    <div class="container-fluid content-area">
        <div class="row mb-3">
            <!-- Keterangan -->
            <div class="col-md-12">
                <h5 class="text-danger">Perhatian!!</h5>
                <p class="text-danger">Ketika ingin mencari hari harap tekan tombol "cari".</p>
                <p class="text-danger">Begitu juga ketika refresh tekan tombol "cari"!</p>
            </div>
            <div class="col-md-3">
                <div class="input-group">
                    <!-- Fitur pencarian -->
                    <form action="{{ url('/D_Jadwal') }}" method="GET" id="searchForm">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="Search Hari.." id="searchInput"
                                name="carihariadmin_jadwal">
                            <button class="btn btn-outline-primary" type="submit">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <!-- Input button -->
                <a href="D_InputJadwal" class="btn btn-outline-primary">Input</a>
            </div>
        </div>
    </div>

    <!-- Table untuk CRUD hasil jadwal -->
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
                        <th>Hari</th>
                        <th>Jam Buka (WIB)</th>
                        <th>Jam Tutup (WIB)</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="myTable">
                    @foreach ($Jadwal as $ja)
                        <tr>
                            <td>{{ $loop->index + 1 + ($Jadwal->currentPage() - 1) * $Jadwal->perPage() }}</td>
                            <td>{{ $ja->hari_jadwal }}</td>
                            <td>{{ $ja->buka_jadwal }} (WIB)</td>
                            <td>{{ $ja->tutup_jadwal }} (WIB)</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <a href="{{ url('/edit_Jadwal/' . $ja->id) }}" class="btn btn-primary">Edit</a>
                                    <button class="btn btn-danger"
                                        onclick="showConfirmDeleteModal({{ $ja->id }})">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-3">
        <nav aria-label="Page navigation">
            <ul class="pagination pagination-sm">
                {{-- Previous Page Link --}}
                @if ($Jadwal->onFirstPage())
                    <li class="page-item disabled">
                        <span class="page-link">&laquo;</span>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $Jadwal->previousPageUrl() }}" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                @endif

                {{-- Pagination Elements --}}
                @foreach ($Jadwal->getUrlRange(1, $Jadwal->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $Jadwal->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach

                {{-- Next Page Link --}}
                @if ($Jadwal->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $Jadwal->nextPageUrl() }}" aria-label="Next">
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
                    // Menggunakan fetch atau jQuery AJAX untuk mengirim permintaan penghapusan
                    fetch(`/delete_Jadwal/${deleteId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire('Sukses', data.message, 'success');
                                location.reload(); // Refresh halaman setelah penghapusan berhasil
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus data.', 'error');
                        });
                }
            });
        }
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi penghapusan semua data -->
    <script>
        function showConfirmDeleteAllModal() {
            Swal.fire({
                title: 'Konfirmasi Penghapusan Semua Jadwal',
                text: "Apakah Anda yakin ingin menghapus semua data jadwal?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus semua!'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/delete_all_Jadwal`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                Swal.fire('Sukses', data.message, 'success');
                                location.reload(); // Refresh halaman setelah penghapusan berhasil
                            } else {
                                Swal.fire('Error', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            Swal.fire('Error', 'Terjadi kesalahan saat menghapus semua jadwal.', 'error');
                        });
                }
            });
        }
    </script>

    <!-- JavaScript untuk SweetAlert konfirmasi data berhasil diinput -->
    <script>
        // Periksa apakah ada pesan sukses dari response JSON
        let successMessage = '{{ Session::get('success') }}';
        if (successMessage) {
            Swal.fire('Sukses', successMessage, 'success');
        }

        // Periksa apakah ada pesan error dari response JSON
        let errorMessage = '{{ Session::get('error') }}';
        if (errorMessage) {
            Swal.fire('Error', errorMessage, 'error');
        }
    </script>


    <!-- JavaScript untuk SweetAlert konfirmasi data berhasil diupdate -->
    <script>
        // Periksa apakah ada pesan sukses dari session
        let successMessage = '{{ session('success') }}';
        if (successMessage) {
            Swal.fire('Sukses', successMessage, 'success');
        }

        // Periksa apakah ada pesan error dari session
        let errorMessage = '{{ session('error') }}';
        if (errorMessage) {
            Swal.fire('Error', errorMessage, 'error');
        }
    </script>

</body>

</html>
