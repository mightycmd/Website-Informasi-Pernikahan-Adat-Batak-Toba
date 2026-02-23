<?php
include 'inc/koneksi.php';
include 'inc/fungsi.php';
global $connect;
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo ambilprofilweb('meta_desc'); ?>">
  <meta name="keywords" content="<?php echo ambilprofilweb('meta_key'); ?>">
  <meta name="author" content="">
  <title><?php echo ambilprofilweb('title_site'); ?></title>
  <!-- Bootstrap core CSS -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" type="image/png" href="icon.png" sizes="196x196" />
  <!-- Custom styles for this template -->
  <link href="assets/blog-home.css" rel="stylesheet">
  <style>
    body {
    margin: 0;
    padding: 0;
  }

  .site-header {
    background-color: #C9DABF; /* Warna biru tua untuk header */
    color: #ffffff; /* Warna teks putih */
    padding:  0;
    text-align: center;
    box-shadow: 0 3px 4px rgba(0,0,0,0.1); 
  }

  .site-header .header-logo {
    max-width: 250px;
    height: auto;
    margin-bottom: 0 /* Menghilangkan margin bawah logo */
  }

  .navbar {
    background-color: #C9DABF;
    padding: 0;
    margin-bottom: 20px;
    box-shadow: 0 3px 4px rgba(0,0,0,0.1);
  }

  .header-content {
    display: flex;
    align-items: center;
    justify-content: flex-start;
  }

  .header-logo {
    max-width: 60px; /* Sesuaikan ukuran logo */
    height: auto;
    margin-right: 20px; /* Jarak antara logo dan teks */
    margin-top: 10px;
  }

  .site-title {
    margin: 0;
    font-size: 2em;
    color: #ffffff;
  }
  .content {
    margin-top: 20px; /* Menambahkan jarak di atas konten */
  }


  .navbar-light .navbar-nav .nav-link {
    color: #000000;
    font-family: 'Arial', sans-serif;
    font-weight: 600;
  }
  .navbar-nav {
    align-items: center;
  }

  .navbar-light .navbar-nav .nav-link:hover {
    color: #f8f9fa;
  }
  .navbar-nav .nav-item {
    margin-left: 15px; /* Memberikan jarak antar item menu */
  }

  

  
  
  .dropdown-menu {
    display: none;
    position: absolute;
    background-color: #f8f9fa;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
  }

  .dropdown-menu.show {
    display: block;
  }

  .dropdown-item {
    color: #000000;
    padding: .5rem 1rem;
    font-weight: 400;
    color: #007a9a;
  }

  .dropdown-item:hover, .dropdown-item:focus {
    color: #16181b;
    background-color: #e9ecef;
    
  }
  </style>
</head>

<body>
  <!-- New Header -->
  <header class="site-header">
    <div class="container">
      <div class="header-content">
        <img src="image/logo4.png" alt="Logo" class="header-logo">
      </div>
    </div>
  </header>

  <!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="./">Home</a>
        </li>
        
        <!-- Kategori Dropdown (Tahap Prosesi) -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-haspopup="true" aria-expanded="false">
              Prosesi
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <?php 
              $query = "SELECT * FROM kategori WHERE terbit = 1 ORDER BY ID DESC";
              $result = mysqli_query($connect, $query);
              while ($row = mysqli_fetch_assoc($result)) : 
            ?>
              <a class="dropdown-item" href="./?open=cat&id=<?= $row['id']; ?>"><?= htmlspecialchars($row['kategori']); ?></a>
            <?php endwhile; ?>
          </div>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="kontak.php">Kontak Kami</a>
        </li>
        
        
        
      </ul>
    </div>
  </div>
</nav>
  

  <!-- Rest of your HTML content -->

  <!-- Bootstrap core JavaScript -->
  <script src="assets/vendor/jquery/jquery.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script>
    $(document).ready(function(){
      $('.dropdown-toggle').on('click', function(e){
        e.preventDefault();
        e.stopPropagation();
        $('.dropdown-toggle').not(this).removeClass('active');
        $('.dropdown-menu').not($(this).siblings('.dropdown-menu')).removeClass('show');
        $(this).toggleClass('active');
        $(this).siblings('.dropdown-menu').toggleClass('show');
      });
      
      $(document).on('click', function(e){
        if(!$(e.target).closest('.dropdown').length){
          $('.dropdown-menu').removeClass('show');
          $('.dropdown-toggle').removeClass('active');
        }
      });
    });
  </script>
</body> 

</html>