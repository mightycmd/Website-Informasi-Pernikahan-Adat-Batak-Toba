<?php 

$jumlahDataPerhalaman = 3;
$dataProsesi = mysqli_query($connect, "SELECT * FROM prosesi");
$jumlahData = mysqli_num_rows($dataProsesi);
$jumlahHalaman = ceil($jumlahData / $jumlahDataPerhalaman);

if (isset($_GET['halaman'])) {
  $halamanAktif = $_GET['halaman'];
} else {
  $halamanAktif = 1;
}

$awalData = ( $jumlahDataPerhalaman * $halamanAktif ) - $jumlahDataPerhalaman;

?>

<!-- Blog Post -->
<?php 
	$query = "SELECT * FROM prosesi WHERE terbit = '1' ORDER BY id DESC LIMIT $awalData, $jumlahDataPerhalaman";
	$result = mysqli_query($connect, $query);
?>
<?php while ( $row = mysqli_fetch_assoc($result) ) : ?>
<div class="card mb-4" style="margin-top: 32px;">
  <img class="card-img-top" src="<?= $row['gambar']; ?>" alt="Card image cap">
  <div class="card-body">
    <h2 class="card-title"><?= $row['judul']; ?></h2>
    <p class="card-text"><?= substr(strip_tags($row['isi']),0,200); ?>. . . .</p>
    <a href="./?open=detail&id=<?= $row['id']; ?>" class="btn btn-primary">Baca Selengkapnya &rarr;</a>
  </div>
  <div class="card-footer text-muted">
  	<?php $date = $row['tanggal'];
  	  $newDate = date("d-F-Y , H:i:s", strtotime($date)); ?>
  	<?= "Posted on ". $newDate; ?>
    
  </div>
</div>
<?php endwhile; ?>

<!-- Pagination -->
<ul class="pagination justify-content-center mb-4">
  <?php if( $halamanAktif > 1) : ?>
  <li class="page-item">
    <a class="page-link" href="?halaman=<?= $halamanAktif - 1; ?>">&larr; Prosesi Sebelumnya</a>
  </li>
  <?php endif; ?>
  <?php if( $halamanAktif < $jumlahHalaman) : ?>
  <li class="page-item">
    <a class="page-link" href="?halaman=<?= $halamanAktif + 1; ?>">Prosesi Lain &rarr;</a>
  </li>
  <?php endif; ?>
</ul>

<?php

include("footer.php");

?>