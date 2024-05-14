<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promo Produk AQUAVITA II</title>

    <!-- Tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    
   <!-- Tautan awesome font -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">


    <!-- CSS Khusus untuk Halaman Promo -->
    <style>
        .promo-container {
            margin-top: 100px;
        }

        .promo-card {
            margin-bottom: 20px;
        }

        .promo-image {
            max-height: 300px;
            object-fit: cover;
        }

        .whatsapp-link {
            display: inline-block;
            background-color: #25d366;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .whatsapp-link:hover {
            background-color: #128c7e;
        }
    </style>
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

    <div class="container promo-container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <!-- Promo 1 -->
                <div class="card promo-card">
                    <img src="{{ asset('image/kontak.png') }}" class="card-img-top promo-image" alt="promo">
                    <div class="card-body">
                        <h2 class="text-center">Hubungi Kami</h2>
                        <p class="text-center">Klik link WhatsApp di bawah ini untuk menghubungi kami:</p>
                        <div class="text-center">
                            <a href="https://wa.me/6281235624725" class="whatsapp-link">
                                Hubungi via WhatsApp <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                       <!-- Tombol Kembali ke Halaman Utama -->
                       <div class="card-body text-center">
                        <a href="{{url('/')}}" class="btn btn-primary mx-5">
                            <i class="fas fa-arrow-left"></i> Kembali ke Halaman Utama
                        </a>
                       </div>
                </div>
            </div>
        </div>
    </div>

     <!-- Footer -->
 <footer class="bg-primary text-light text-center py-3">
    <p>&copy; 2024 AQUAVITA II</p>
</footer>

    <!-- Tautan ke file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>
