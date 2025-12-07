<?php
session_start();
include 'koneksi.php';

// Jika sudah login, langsung ke dashboard
if (isset($_SESSION['user'])) { header("location: dashboard.php"); exit; }

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']); // Ingat: Production gunakan password_verify

    $query = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' AND password='$password'");
    
    if (mysqli_num_rows($query) > 0) {
        $_SESSION['user'] = $username;
        header("location: dashboard.php");
    } else {
        $error = "Username atau Password salah.";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Staff - Klinik Amanah</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #0d6efd 0%, #0099ff 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-login {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.2);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
        }
        .card-header {
            background: white;
            border-bottom: none;
            padding-top: 30px;
            text-align: center;
        }
        .login-icon {
            font-size: 3rem;
            color: #0d6efd;
            background: #e7f1ff;
            width: 80px;
            height: 80px;
            line-height: 80px;
            border-radius: 50%;
            display: inline-block;
            margin-bottom: 10px;
        }
        .form-control {
            border-radius: 10px;
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #eee;
        }
        .form-control:focus {
            background-color: #fff;
            box-shadow: none;
            border-color: #0d6efd;
        }
        .btn-login {
            border-radius: 10px;
            padding: 12px;
            font-weight: bold;
            font-size: 1rem;
            transition: 0.3s;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(13, 110, 253, 0.3);
        }
        .back-link {
            text-decoration: none;
            color: rgba(255,255,255,0.8);
            margin-top: 20px;
            display: block;
            text-align: center;
            font-size: 0.9rem;
        }
        .back-link:hover { color: white; }
    </style>
</head>
<body>

    <div class="container">
        <div class="d-flex flex-column align-items-center">
            
            <div class="card card-login bg-white p-4">
                <div class="card-header">
                    <div class="login-icon">
                        <i class="bi bi-shield-lock-fill"></i>
                    </div>
                    <h4 class="fw-bold text-dark">Portal Staff</h4>
                    <p class="text-muted small">Silakan login untuk mengelola klinik</p>
                </div>
                
                <div class="card-body">
                    <?php if(isset($error)) { ?>
                        <div class="alert alert-danger py-2 text-center small rounded-3 border-0">
                            <i class="bi bi-exclamation-circle me-1"></i> <?= $error; ?>
                        </div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label small text-muted fw-bold">USERNAME</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-person"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Masukkan username" required>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label small text-muted fw-bold">PASSWORD</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-0"><i class="bi bi-key"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Masukkan password" required>
                            </div>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary w-100 btn-login mb-2">
                            MASUK DASHBOARD
                        </button>
                    </form>
                </div>
            </div>

            <a href="index.php" class="back-link">
                <i class="bi bi-arrow-left"></i> Kembali ke Halaman Depan
            </a>

        </div>
    </div>

</body>
</html>