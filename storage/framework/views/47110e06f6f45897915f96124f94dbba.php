<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Sign In - Wardah Beauty</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .signin-container {
            max-width: 400px;
            margin: 60px auto;
            padding: 30px 25px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        }

        .brand-logo {
            display: block;
            margin: 0 auto 25px auto;
            max-width: 120px;
        }

        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(255, 99, 71, 0.25);
            border-color: #ff6347;
            /* tomato color */
        }

        .btn-primary {
            background-color: #ff6347;
            border-color: #ff6347;
        }

        .btn-primary:hover {
            background-color: #e5533d;
            border-color: #e5533d;
        }

        .form-text a {
            color: #ff6347;
            text-decoration: none;
        }

        .form-text a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <?php echo e($slot); ?>

    <div class="signin-container shadow-sm">
        <!-- Logo -->
        <img src="https://www.wardahbeauty.com/skin/frontend/wardah/default/images/logo-wardah.svg" alt="Wardah Logo"
            class="brand-logo" />

        <h3 class="text-center mb-4 fw-semibold">Masuk ke Akun Anda</h3>

        <form>
            <div class="mb-3">
                <label for="inputEmail" class="form-label">Alamat Email</label>
                <input type="email" class="form-control" id="inputEmail" placeholder="email@contoh.com" required />
            </div>

            <div class="mb-3">
                <label for="inputPassword" class="form-label">Kata Sandi</label>
                <input type="password" class="form-control" id="inputPassword" placeholder="Masukkan kata sandi"
                    required />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe" />
                    <label class="form-check-label" for="rememberMe">Ingat Saya</label>
                </div>
                <a href="#" class="small">Lupa Kata Sandi?</a>
            </div>

            <button type="submit" class="btn btn-primary w-100 mb-3">Masuk</button>

            <div class="text-center form-text">
                Belum punya akun? <a href="#">Daftar di sini</a>
            </div>
        </form>
    </div>

    <!-- Bootstrap 5 JS Bundle (Popper + Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
<?php /**PATH C:\laragon\www\ecommerce\resources\views/components/layouts/signin.blade.php ENDPATH**/ ?>