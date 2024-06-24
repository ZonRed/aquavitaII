<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Isi Penjadwalan</title>

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <style>
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
    
            @media (max-width: 768px) {
                .sidebar {
                    position: static;
                    width: 100%;
                    height: auto;
                    padding: 15px 0;
                }
    
                .content-area {
                    margin-left: 0;
                    padding-left: 15px; /* Berikan padding kiri untuk konten pada layar kecil */
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
                background-color: #fff; /* Tambahkan background color untuk tetap terlihat */
                padding: 5px 10px; /* Berikan padding agar tidak terlalu kecil */
                border-radius: 5px; /* Tambahkan border radius untuk tampilan yang lebih baik */
            }
    
            @media (max-width: 768px) {
                .fixed-top-right {
                    position: static;
                    margin-top: 10px;
                    text-align: center;
                    margin-bottom: 10px; /* Tambahkan margin bottom agar tidak menumpuk */
                }
            }
        </style>
</head>

<body>
    <!-- Content area for Input jual -->
    <section id="input-jadwal" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Input Isi Penjadwalan</h2>

            <!-- user admin tampilan -->
            <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
                <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
                <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
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
                            <label for="hari_jadwal" class="form-label">Hari <span class="text-danger">(tidak boleh sama "Hari" dengan
                                lainnya!)</span>
                                <span class="text-danger">*</span></label>
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
                            <label for="buka_jadwal" class="form-label">Waktu Buka <span
                                    class="text-danger">*</span></label>
                            <input type="time" class="form-control" id="buka_jadwal" name="buka_jadwal" required>
                        </div>

                        <!-- Input untuk waktu tutup -->
                        <div class="mb-3">
                            <label for="tutup_jadwal" class="form-label">Waktu Tutup <span
                                    class="text-danger">*</span></label>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

<!-- Skrip JavaScript untuk menampilkan SweetAlert -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let errorMessage = "{{ session('error') }}";
        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage,
            });
        }
    });
</script>

    
</body>

</html>
