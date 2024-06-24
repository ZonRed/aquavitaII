<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Portal Berita Mang Ujang</title>
    <!-- Tambahkan tautan ke file CSS Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

    <!-- Tambahkan tautan ke Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Tambahkan tautan ke file JQUERY ajax -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <!-- Navigasi -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
        <div class="container">
            <!-- Brand tengah -->
            <a class="navbar-brand mx-auto" href="#">AQUAVITA II ADMIN</a>
        </div>
    </nav>
    <!-- Konten Halaman Register -->
    <section id="register" class="py-5" style="margin-top: 50px; margin-bottom: 50px;">
        <div class="container" style="height: 100%; align-content: center;">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8 col-sm-10">
                    <div class="card" style="width: 100%; max-width: 400px; margin: auto;">
                        <div class="card-header text-center">
                            <h2>Register - AQUAVITA II ADMIN</h2>
                        </div>
                        <div class="card-body">
                            <!-- Formulir Register -->
                            <form action="/simpanuser" method="POST">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-label">Nama
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="nama" class="form-control" autofocus required
                                        autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="email" name="email" class="form-control" required
                                        autocomplete="off">
                                </div>
                                <div class="mb-3 position-relative">
                                    <label for="password" class="form-label">Password
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="input-group">
                                        <input type="password" id="password" name="password" class="form-control"
                                            required autocomplete="off">
                                        <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <input name="" id="" class="btn btn-primary" type="submit"
                                        value="Register">
                                </div>
                            </form>
                            <!-- Bagian pesan kesalahan -->
                            <div id="password-error" style="color: red; text-align: center; margin-top: 5px;"></div>
                            <!-- Elemen untuk menampilkan pesan sukses -->
                            <div id="success-message" style="color: green; text-align: center; margin-top: 5px;"></div>
                            <!-- Bagian pertanyaan sudah punya akun? -->
                            <small class="text-center mt-3">Sudah punya akun? <a href="login">Login</a>
                                sekarang</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-primary fixed-bottom text-light text-center py-2">
        <p>&copy; 2024 AQUAVITA II</p>
    </footer>

    <!-- Tambahkan AJAX filter maksimal input password ,email dan nama sudah di gunakan/belum -->
    <script>
        $(document).ready(function() {
            $('form').submit(function(e) {
                e.preventDefault();
                var password = $('input[name="password"]').val();
                var email = $('input[name="email"]').val();
                var nama = $('input[name="nama"]').val();

                // Clear previous messages
                $('#password-error').text('');
                $('#email-error').text('');
                $('#nama-error').text('');
                $('#success-message').text('');

                if (password.length > 5) {
                    $('#password-error').text('Maksimal panjang password 5 karakter!');
                } else if (password.length < 3) {
                    $('#password-error').text('Minimum pendek password 3 karakter!');
                } else {
                    $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        success: function(response) {
                            $('#success-message').text('Registration successful!');
                            console.log(response);
                            $('#password-error').text('');
                        },
                        error: function(xhr, status, error) {
                            var err = JSON.parse(xhr.responseText);
                            if (err.error) {
                                $('#password-error').text(err.error);
                            }
                            console.log(err);
                            $('#success-message').text('');
                        }
                    });
                }
            });

            // script mata
            $('#togglePassword').click(function() {
                var passwordInput = $('#password');
                var passwordIcon = $('#togglePassword').find('i');
                if (passwordInput.attr('type') === 'password') {
                    passwordInput.attr('type', 'text');
                    passwordIcon.removeClass('bi-eye').addClass('bi-eye-slash');
                } else {
                    passwordInput.attr('type', 'password');
                    passwordIcon.removeClass('bi-eye-slash').addClass('bi-eye');
                }
            });
        });
    </script>

    <!-- Tambahkan tautan ke file JavaScript Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>
