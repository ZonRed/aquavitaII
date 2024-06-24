<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Input Isi Penjualan</title>

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
    <section id="input-jual" class="py-5">
        <div class="container-fluid content-area">
            <h2>Admin Dashboard - Input Isi Penjualan</h2>

            <!-- user admin tampilan -->
            <div style="position: fixed; top: 10px; right: 10px; z-index: 100;">
                <!-- Ganti 'Nama User' dengan nama pengguna yang sedang masuk -->
                <span style="color: #000; font-weight: bold;">{{ Auth::user()->nama ?? '' }}</span>
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
                            <label for="tanggal_jual" class="form-label">Tanggal
                                <span class="text-danger">*</span>
                            </label>
                            <input type="date" class="form-control" name="tanggal_jual" required>
                        </div>

                        <!-- Input untuk code_barang -->
                        <div class="mb-3">
                            <label for="code_jual" class="form-label">Code Barang <span class="text-danger">(tidak boleh sama "code barang" dengan
                                lainnya!)</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="number" class="form-control" name="code_jual" required>
                        </div>

                        <!-- Input untuk type -->
                        <div class="mb-3">
                            <label for="type_jual" class="form-label">Type Barang <span class="text-danger">(tidak boleh sama "type barang" dengan
                                lainnya!)</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="type_jual" required>
                        </div>

                        <!-- Input untuk harga -->
                        <div class="mb-3">
                            <label for="harga_jual" class="form-label">Harga
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="harga_jual" id="harga_jual" required>
                        </div>

                        <!-- Input untuk stock -->
                        <div class="mb-3">
                            <label for="stock_jual" class="form-label">Stock
                                <span class="text-danger">*</span>
                            </label>
                            <select class="form-select" name="stock_jual" required>
                                <option value="Ada">Ada</option>
                                <option value="Kosong">Kosong</option>
                            </select>
                        </div>
                        <!-- Input untuk jumlah barang -->
                        <div class="mb-3">
                            <label for="jumlah_jual" class="form-label">Jumlah Stock <span class="text-danger">(jika tidak ada ,isi dengan angka
                                "0")</span>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" class="form-control" name="jumlah_jual" required>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Script untuk format harga_jual -->
    <script>
        document.getElementById('harga_jual').addEventListener('input', function(e) {
            var value = e.target.value.replace(/[^0-9]/g, '');
            e.target.value = new Intl.NumberFormat('id-ID', {
                minimumFractionDigits: 2
            }).format(value / 100);
        });

        document.getElementById('jualForm').addEventListener('submit', function(e) {
            var hargaInput = document.getElementById('harga_jual');
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
