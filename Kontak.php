<?php

include("../inc/koneksi.php");

if(!isset($_SESSION["login"])) {
    header("Location: ceklogin.php");
    exit;
}

// Fungsi untuk sanitasi input
function sanitize_input($connect, $input) {
    return mysqli_real_escape_string($connect, htmlspecialchars(trim($input)));
}

// Hapus pesan
if(isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "DELETE FROM pesan_kontak WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "i", $id);
    if(mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Pesan berhasil dihapus'); window.location='index.php?mod=kontak';</script>";
    } else {
        echo "<script>alert('Gagal menghapus pesan: " . mysqli_error($connect) . "');</script>";
    }
    mysqli_stmt_close($stmt);
}

// Proses balasan
if(isset($_POST['balas'])) {
    $id = intval($_POST['id']);
    $balasan = sanitize_input($connect, $_POST['balasan']);
    $query = "UPDATE pesan_kontak SET status = 'Dibalas', balasan = ?, tanggal_balasan = NOW() WHERE id = ?";
    $stmt = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt, "si", $balasan, $id);
    if(mysqli_stmt_execute($stmt)) {
        // Kirim email balasan (opsional)
        $pesan = mysqli_fetch_assoc(mysqli_query($connect, "SELECT * FROM pesan_kontak WHERE id = $id"));
        $to = $pesan['email'];
        $subject = "Re: " . $pesan['subjek'];
        $message = $balasan;
        $headers = "From: admin@yourdomain.com\r\n";
        mail($to, $subject, $message, $headers);
        
        echo "<script>alert('Balasan berhasil dikirim'); window.location='index.php?mod=kontak';</script>";
    } else {
        echo "<script>alert('Gagal mengirim balasan: " . mysqli_error($connect) . "');</script>";
    }
    mysqli_stmt_close($stmt);
}

// Ambil semua pesan
$result = mysqli_query($connect, "SELECT * FROM pesan_kontak ORDER BY tanggal DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kelola Pesan </title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Kelola Pesan </h2>
        <div class="table-responsive">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Pesan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['tanggal']); ?></td>
                        <td><?php echo htmlspecialchars($row['nama']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars(substr($row['pesan'], 0, 50)) . '...'; ?></td>
                        <td><?php echo htmlspecialchars($row['status'] ?? 'Baru'); ?></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="showMessageDetail(<?php echo $row['id']; ?>, '<?php echo addslashes(htmlspecialchars($row['pesan'])); ?>')">Lihat Detail</button>
                            <button class="btn btn-primary btn-sm" onclick="showReplyForm(<?php echo $row['id']; ?>)">Balas</button>
                            <a href="?mod=kontak&hapus=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">Hapus</a>
                        </td>
                    </tr>
                    <tr id="replyForm<?php echo $row['id']; ?>" style="display: none;">
                        <td colspan="7">
                            <form method="post">
                                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                <textarea name="balasan" class="form-control" rows="3" required></textarea>
                                <button type="submit" name="balas" class="btn btn-success mt-2">Kirim Balasan</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Modal untuk menampilkan detail pesan -->
        <div class="modal fade" id="messageDetailModal" tabindex="-1" role="dialog" aria-labelledby="messageDetailModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="messageDetailModalLabel">Detail Pesan</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="messageDetailContent">
                        <!-- Isi pesan akan ditampilkan di sini -->
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
    function showReplyForm(id) {
        document.getElementById('replyForm' + id).style.display = 'table-row';
    }

    function showMessageDetail(id, message) {
        document.getElementById('messageDetailContent').innerHTML = message.replace(/\n/g, '<br>');
        $('#messageDetailModal').modal('show');
    }
    </script>
</body>
</html>