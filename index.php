<?php

include("header.php");

?>

<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <!-- Konten lainnya (misalnya gambar atau teks) -->
      <div class="content-section">
        <?php
        $open = isset($_GET['open']) ? $_GET['open'] : '';
        switch ($open) {
          case 'detail':
            include("detail.php");
            break;
          case 'cat':
            include("kategori.php");
            break;
          case 'cari':
            include("cari.php");
            break;
          default:
            include("depan.php");
            break;
        }
        ?>
      </div>
      
      

    </div>

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4 mt-2">

      <!-- Search Widget -->
      <form action="" method="GET">
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" name="key" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" name="open" type="submit" value="cari">Go!</button>
            </span>
          </div>
        </div>
      </div>
      </form>

      <!-- Categories Widget / Berita Terbaru -->
      <div class="card my-4">
        <h5 class="card-header">Prosesi lainnya</h5>
        <?php 
          $query = "SELECT * FROM prosesi WHERE terbit = '1' ORDER BY id DESC LIMIT 0,10";
          $result = mysqli_query($connect, $query);
        ?>
        <div class="card-body">
          <ul class="list-group">
          <?php while( $row = mysqli_fetch_assoc($result)) : ?>
            <li class="list-group-item d-flex justify-content-between align-items-left">
              <a href="./?open=detail&id=<?=$row['id']; ?>" class="badge-light" style="text-decoration: none;"><b><?= $row['judul']; ?></b></a>
              <img src="<?= $row['gambar']; ?>" style="max-width: 5rem; ">
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-left">
              <?php 
                $date = $row['tanggal'];
                $newDate = date("d-M-Y, H:i:s", strtotime($date)); ?>
              <?= $newDate; ?> |
              Dilihat : <?= $row['viewnum']; ?>
            </li>
          <?php endwhile; ?>
          </ul>
        </div>
      </div>

      
<!-- /.container -->


