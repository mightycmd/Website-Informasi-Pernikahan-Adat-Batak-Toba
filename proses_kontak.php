<?php
session_start();
include 'inc/koneksi.php';
include 'inc/fungsi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $email = mysqli_real_escape_string($connect, $_POST['email']);
    $pesan = mysqli_real_escape_string($connect, $_POST['pesan']);
    $tanggal = date("Y-m-d H:i:s");

    $sql = "INSERT INTO pesan_kontak (nama, email, pesan, tanggal, status) VALUES (?, ?, ?, ?, 'Baru')";
    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssss", $nama, $email, $pesan, $tanggal);

    if ($stmt->execute()) {
        // Simpan email di session dan cookie
        $_SESSION['user_email'] = $email;
        setcookie('user_email', $email, time() + (86400 * 30), "/"); // Cookie berlaku 30 hari
        
        echo "<script>alert('Pesan Anda telah terkirim. Terima kasih telah memberikan kritik dan saran kepada kami.'); window.location.href='kontak.php';</script>";
    } else {
        echo "<script>alert('Maaf, terjadi kesalahan. Silakan coba lagi nanti.'); window.location.href='kontak.php';</script>";
    }
    $stmt->close();
}
?>