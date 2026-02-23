<?php 
session_start();
include 'inc/koneksi.php';
include 'header.php'; 

// Cek apakah ada email yang disimpan di session atau cookie
$user_email = isset($_SESSION['user_email']) ? $_SESSION['user_email'] : (isset($_COOKIE['user_email']) ? $_COOKIE['user_email'] : '');
?>

<div class="container mt-5 mb-5">
  <h2 class="mb-4">Kritik dan Saran</h2>
  <div class="row">
    <div class="col-md-6">
      <form action="proses_kontak.php" method="POST">
        <div class="form-group">
          <label for="nama">Nama</label>
          <input type="text" class="form-control" id="nama" name="nama" required>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
          <label for="pesan">Pesan</label>
          <textarea class="form-control" id="pesan" name="pesan" rows="5" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary mb-5">Kirim Pesan</button>
      </form>
    </div>
    <div class="col-md-6">
      <h4>Informasi Kami</h4>
      <p><strong>Telepon: 082312214897</strong> <?php echo ambilprofilweb('telepon'); ?></p>
      <p><strong>Email: revaldyjules@gmail.com</strong> <?php echo ambilprofilweb('email'); ?></p>
      <p>
        <strong>Ikuti Kami:</strong><br>
        <a href="https://www.instagram.com/revaldyjules/" target="_blank">
          <img src="image/ig1.png" alt="Instagram" style="width: 30px; height: 30px;">
        </a>
        <a href="https://x.com/revaldy_jules" target="_blank">
          <img src="image/twitter1.png" alt="Twitter" style="width: 30px; height: 30px;">
        </a>
        <a href="https://www.facebook.com/revaldyjules" target="_blank">
          <img src="image/facebook1.png" alt="Facebook" style="width: 30px; height: 30px;">
        </a>
      </p>
      
    </div>
  </div>

  <!-- Bagian untuk menampilkan pesan dan balasan -->
  <div class="row mt-5">
    <div class="col-12">
      <h3>Pesan dan Balasan</h3>
      <?php if ($user_email): ?>
        <?php
        $query = "SELECT * FROM pesan_kontak WHERE email = ? ORDER BY tanggal DESC";
        $stmt = $connect->prepare($query);
        $stmt->bind_param("s", $user_email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0):
          while ($row = $result->fetch_assoc()):
        ?>
          <div class="card mb-3">
            <div class="card-body">
              <p class="card-text"><strong>Pesan Anda:</strong> <?php echo htmlspecialchars($row['pesan']); ?></p>
              <p class="card-text"><small class="text-muted">Dikirim pada: <?php echo $row['tanggal']; ?></small></p>
              <?php if ($row['status'] == 'Dibalas'): ?>
                <div class="alert alert-info">
                  <h6>Balasan Admin:</h6>
                  <p><?php echo htmlspecialchars($row['balasan']); ?></p>
                  <small>Dibalas pada: <?php echo $row['tanggal_balasan']; ?></small>
                </div>
              <?php else: ?>
                <p class="text-muted">Belum ada balasan</p>
              <?php endif; ?>
            </div>
          </div>
        <?php 
          endwhile;
        else:
          echo "<p>Anda belum memiliki pesan.</p>";
        endif;
        ?>
      <?php else: ?>
        <p>Silakan kirim pesan untuk melihat balasan.</p>
      <?php endif; ?>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>
