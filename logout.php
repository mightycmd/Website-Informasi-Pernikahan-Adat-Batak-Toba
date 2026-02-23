<?php 
session_start();
$_SESSION = []; // Mengosongkan semua variabel session
session_unset(); // Menghapus semua session
session_destroy(); // Menghancurkan session

// Mengubah lokasi redirect ke halaman ceklogin
header("Location: ceklogin.php"); // Pastikan path ini benar
exit; // Menghentikan eksekusi skrip
?> 