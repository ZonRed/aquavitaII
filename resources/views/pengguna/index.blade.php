<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promosi Penjualan AQUAVITA II</title>

    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Tautan ke library SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Tambahkan tautan api herestyle -->
    <link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />

    <style>
        .card {
            max-height: 100%;
            /* Mengatur tinggi maksimum card */
            overflow: hidden;
            /* Menyembunyikan konten yang melebihi tinggi maksimum */

        }

        .card-img-top {
            width: 100%;
            height: 200px;
            /* Mengatur tinggi gambar card sesuai kebutuhan Anda */
            object-fit: cover;
        }

        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- Navigasi -->
    <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">AQUAVITA II</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#beranda">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#informasi-penjualan">Informasi Penjualan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#lokasi-map">Lokasi Map</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#keluh-kesah">Keluh Kesah</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Beranda (Berada) -->
    <section id="beranda" class="py-5" style="margin-top: 80px;">
        <div class="container text-center">
            <div class="col text-center">
                <h3>Beranda</h3>
                <h1>~Selamat datang di "AQUAVITA II"~</h1>
                <p>"AQUAVITA II - tempat terpercaya untuk mendapatkan minuman berkualitas dan es batu yang segar
                    sepanjang hari!" </p>
            </div>
        </div>
    </section>

    <!-- Informasi Penjualan -->
    <section id="informasi-penjualan" class="bg-light py-5">
        <div class="container">
            <div class="col text-center mb-4">
                <h3>Informasi Penjualan</h3>
            </div>
            <!-- Informasi Penjualan -->
            <div class="row">
                <!-- Jadwal Operasional -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/jadwal_operasional.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top"
                            alt="Berita 1">

                        <div class="card-body">
                            <h3 class="card-title">Jadwal Operasional</h3>
                            <p class="card-text">Berisi : Jadwal Operasional Toko Aquavita II</p>
                            <a href="Jadwal" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Produk Penjualan -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/produk_penjualan.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top"
                            alt="Berita 2">

                        <div class="card-body">
                            <h3 class="card-title">Produk Penjualan</h3>
                            <p class="card-text">Berisi : type, ukuran, harga, dan stock</p>
                            <a href="Jual" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- Promo -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/promo.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top"
                            alt="Berita 3">
                        <div class="card-body">
                            <h3 class="card-title">Promo</h3>
                            <p class="card-text">Berisi : Promo Yang sedang berlangsung</p>
                            <a href="Promo" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
                <!-- kontak di hubungi -->
                <div class="col-md-4">
                    <div class="card mb-4">
                        <img src="{{ asset('image/kontak.png') }}"
                            style="max-width: 100%; height: auto; object-fit: cover;" class="card-img-top"
                            alt="Berita 4">
                        <div class="card-body">
                            <h3 class="card-title">Kontak</h3>
                            <p class="card-text">Berisi : nomer WA, untuk pemesanan</p>
                            <a href="Kontak" class="btn btn-primary">Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Lokasi Map -->
    <section id="lokasi-map" class="py-5">
        <div class="container">
            <div class="col text-center">
                <h3>Lokasi AQUAVITA II</h3>
                <p>Tempat Lokasi "AQUAVITA II" , Untuk Petunjuk Lokasi Google Map bisa tekan tombol 'Buka di Google
                    Maps' di bawah map</p>
            </div>
            <!-- Add a container for the map -->
            <div id="map"></div>
            <div class="text-center mt-3">
                <button class="btn btn-primary" id="openGoogleMapsBtn">Buka di Google Maps</button>
            </div>
        </div>
    </section>

    <!-- keluh kesah -->
    <section id="keluh-kesah" class="py-5">
        <div class="container">
            <div class="col text-center">
                <h3>Keluh Kesah AQUAVITA II</h3>
                <p>Jika Anda memiliki pertanyaan atau masukan, jangan ragu untuk berkeluh kesah melalui formulir di
                    bawah ini.</p>
            </div>
            <!-- Tambahkan formulir kontak di sini jika diperlukan -->
            <form action="{{ url('SaveLaporan') }}" method="POST">
                @csrf
                <!-- Input untuk Nama -->
                <div class="mb-3">
                    <label for="nama_laporan" class="form-label">Nama
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="nama_laporan" required>
                </div>

                <!-- Input untuk Email -->
                <div class="mb-3">
                    <label for="email_laporan" class="form-label">Email
                        <span class="text-danger">*</span>
                    </label>
                    <input type="email" class="form-control" name="email_laporan" required>
                </div>

                <!-- Input untuk Kritikan -->
                <div class="mb-3">
                    <label for="pesan_laporan" class="form-label">Pesan
                        <span class="text-danger">*</span>
                    </label>
                    <input type="text" class="form-control" name="pesan_laporan" required>
                </div>
                <!-- kirim pesan -->
                <input type="submit" value="Kirim" class="btn btn-primary">
            </form>
        </div>
    </section>




    <!-- Footer -->
    <footer class="bg-primary text-light text-center py-3">
        <p>&copy; 2024 AQUAVITA II</p>
    </footer>

    <!-- Tambahkan tautan ke file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>

    <!-- Tambahkan tautan ke library jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Replace the Google Maps API script with HERE Maps API script -->
    <script src="https://js.api.here.com/v3/3.1/mapsjs-core.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-service.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js"></script>
    <script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js"></script>



    <!-- Add the following script for HERE Maps -->
    <script>
        function initializeMap() {
            const platform = new H.service.Platform({
                apikey: "v0UpMK3EXITJJAAkMChM_mCOktil9_ddFSpiQRwnhGo"
            });
            const defaultLayers = platform.createDefaultLayers();
            const map = new H.Map(
                document.getElementById("map"),
                defaultLayers.vector.normal.map, {
                    center: {
                        lat: -7.3723192539977065,
                        lng: 112.73006055952578
                    },
                    zoom: 8, // Adjust the initial zoom level
                    pixelRatio: window.devicePixelRatio || 1,
                }
            );
            window.addEventListener("resize", () => map.getViewPort().resize());
            const behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(map));
            const ui = H.ui.UI.createDefault(map, defaultLayers);

            // Function to add markers to the map
            function addMarkersToMap(map) {
                var fanbasemarker = new H.map.Marker({
                    lat: -7.3723192539977065,
                    lng: 112.73006055952578
                });
                map.addObject(fanbasemarker);
            }

            // Call the function to add markers when the window is loaded
            window.onload = function() {
                addMarkersToMap(map);
            }
        }

        // Initialize the map when the script is loaded
        initializeMap();

        // Function to open the location in Google Maps
        function openGoogleMaps() {
            const fanbaseLocation = {
                lat: -7.3723192539977065,
                lng: 112.73006055952578
            };
            const googleMapsUrl =
                `https://www.google.com/maps/search/?api=1&query=${fanbaseLocation.lat},${fanbaseLocation.lng}`;
            window.open(googleMapsUrl, '_blank');
        }

        // Set up the click event for the button
        document.getElementById('openGoogleMapsBtn').addEventListener('click', openGoogleMaps);
    </script>

   <!-- Skrip JavaScript untuk menampilkan SweetAlert -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Tangkap session flash message
        let successMessage = "{{ session('success') }}";
        let errorMessage = "{{ session('error') }}";

        // Tampilkan SweetAlert jika pesan sukses atau error ada
        if (successMessage) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: successMessage,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.hash = '#keluh-kesah'; // Arahkan ke bagian "Keluh Kesah"
                }
            });
        }

        if (errorMessage) {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: errorMessage,
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.hash = '#keluh-kesah'; // Arahkan ke bagian "Keluh Kesah"
                }
            });
        }

        // Tambahkan validasi untuk email berakhiran @gmail.com
        document.querySelector('form').addEventListener('submit', function(event) {
            let emailInput = document.querySelector('input[name="email_laporan"]');
            if (!emailInput.value.endsWith('@gmail.com')) {
                event.preventDefault(); // Mencegah pengiriman formulir
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Email harus berakhiran @gmail.com',
                });
            }
        });
    });
</script>


</body>

</html>
