<?php
include '../inc/koneksi.php';
include '../inc/fungsi.php';
session_start();

if(!isset($_SESSION["login"])) {
    header("Location: ceklogin.php");
    exit;
}

$mod = isset($_GET['mod']) ? $_GET['mod'] : '';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Tambahkan link CSS Summernote -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h1>Selamat Datang Di Halaman Admin</h1>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="Index.php">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="?mod=kategori">Kategori</a></li>
                <li class="nav-item"><a class="nav-link" href="?mod=prosesi">Prosesi</a></li>
                <li class="nav-item"><a class="nav-link" href="?mod=kontak"> Kelola Pesan</a></li>
                <li class="nav-item"><a class="nav-link" href="?mod=useradmin">User Admin</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Log Out</a></li>
            </ul>
        </nav>

        <div class="content mt-4">
            <?php
            switch ($mod) {
                case 'kategori':
                    include("Kategori.php");
                    break;
                case 'prosesi':
                    include("prosesi.php");
                    break;
                case 'kontak':
                    include("Kontak.php");
                    break;
                case 'useradmin':
                    include("useradmin.php");
                    break;
                default:
                    echo "<h2>Selamat Datang, " . $_SESSION['nama'] . "!</h2>";
                    echo "<p>Silakan pilih menu di atas untuk mengelola konten.</p>";
                    break;
            }
            ?>
        </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tambahkan script Summernote -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <!-- Inisialisasi Summernote -->
    <script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 300,
            toolbar: [
              ['style', ['style']],
              ['font', ['bold', 'underline', 'clear']],
              ['color', ['color']],
              ['para', ['ul', 'ol', 'paragraph']],
              ['table', ['table']],
              ['insert', ['link', 'picture', 'video']],
              ['view', ['fullscreen', 'codeview', 'help']]
            ]
        });
    });
    </script>
</body>
</html>
</body>
</html>