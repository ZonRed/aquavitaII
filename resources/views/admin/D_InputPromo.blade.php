<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Isi Promo</title>

    <!-- Tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Tautan ke file JavaScript SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tautan ke file JavaScript jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

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

     <!-- Content area for Input promo -->
     <section id="input-promo" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Input Isi Promo</h2>

            <!-- user admin tampilan -->
            <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
                <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
                <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
                <!-- Tambahkan tautan logout di sini -->
                <a href="/logout" style="color: #dc3545; margin-left: 10px; text-decoration: none;">Logout</a>
            </div>

            <!-- Card untuk input Promo -->
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('SavePromo') }}" method="POST">
                        @csrf
                        <!-- Input untuk Tanggal Mulai -->
                        <div class="mb-3">
                            <label for="tanggal_mulai_promo" class="form-label">Tanggal Mulai Promo
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal_mulai_promo" required>
                        </div>

                        <!-- Input untuk Tanggal Akhir  -->
                        <div class="mb-3">
                            <label for="tanggal_akhir_promo" class="form-label">Tanggal Akhir Promo
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal_akhir_promo" required>
                        </div>

                        <!-- Input untuk code promo -->
                        <div class="mb-3">
                            <label for="code_promo" class="form-label">Code Promo <span class="text-danger">(tidak boleh
                                    sama "Code Promo" dengan lainnya!)</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="code_promo" required>
                        </div>

                        <!-- Input untuk type promo -->
                        <div class="mb-3">
                            <label for="type_promo" class="form-label">Barang Promo <span class="text-danger">(tidak boleh
                                sama "Barang Promo" dengan lainnya!)</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="type_promo" required>
                        </div>

                        <!-- Input untuk info promo -->
                        <div class="mb-3">
                            <label for="info_promo" class="form-label">Info Promo
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="info_promo" required>
                        </div>

                        <!-- Input untuk harga promo -->
                        <div class="mb-3">
                            <label for="harga_promo" class="form-label">Harga Promo <span class="text-danger">(jika
                                    tidak ada ,isi dengan angka "0")</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="harga_promo" id="harga_promo" required>
                        </div>


                        <!-- Tombol Submit -->
                        <input type="submit" value="Simpan" class="btn btn-primary">
                        <!-- Back button -->
                        <a href="D_Promo" class="btn btn-outline-primary">View Data</a>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Tautan ke file JavaScript Bootstrap Bundle dengan Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

      <!-- Script untuk format harga promo -->
      <script>
        document.getElementById('harga_promo').addEventListener('input', function(e) {
            var value = e.target.value.replace(/[^0-9]/g, '');
            e.target.value = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2
            }).format(value / 100);
        });

        // Untuk menyimpan nilai harga tanpa pemisah ribuan saat form disubmit
        document.getElementById('promoForm').addEventListener('submit', function(e) {
            var hargaInput = document.getElementById('harga_promo');
            hargaInput.value = hargaInput.value.replace(/[,.]/g, '');
        });
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
